<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MyPageRequest;
use App\Http\Requests\MyPageEditRequest;
use App\Http\Requests\ProfileImageRequest;
use Hash;
use DB;
use App\Libs\Library;
use App\User;
use App\UserInfo;
use Storage;

class MyPageController extends Controller
{
    public function getUser()
    {
        $user = Auth::user();
        return $user;
    }

    public function getUserInfo($userId){
        $user = User::with('userInfo')->find($userId);
        $param = ['user' => $user];
        return $param;
    }

    public function index()
    {
        $user = $this->getUser();
        return view('myPages.index', ['user' => $user]);
    }

    public function userInfo()
    {
        $user = $this->getUserInfo(Auth::user()->id);
        return view('myPages.userInfo', $user);
    }

    public function edit()
    {
        $user = $this->getUserInfo(Auth::user()->id);
        return view('myPages.edit', $user);
    }

    public function passwordEdit()
    {
        $user = $this->getUser();
        return view('myPages.passwordEdit', ['user' => $user]);
    }

    public function passwordStore(MyPageRequest $request)
    {
        $user = $this->getUser();
        $hashedPassword = $user->password;
        $password = $request->new_password;
        if (Hash::check($password, $hashedPassword)){
            if ($request->password == $request->password_confirmation){
                try {
                    $encrypted = Hash::make($request->password);
                    $user->password = $encrypted;
                    $user->save();
                    DB::commit();
                } catch (Exception $e){
                    DB::rollBack();
                    Library::redirectWithErrors('passwordEdit', $e->getMessage());
                }
                return redirect('/mypage/userinfo/');
            } else {
                return redirect('/mypage/passwordEdit');
            }
        } else {
            return redirect('/mypage/passwordEdit')->with('msg', '登録されていないパスワードです');
        }
    }

    public function store(MyPageEditRequest $request)
    {
        $userInfo = UserInfo::all();
        // 下記の書き方だとsqlエラー (Unknown column '_token')となってしまいました。
        // $values = $request->all();
        $values = $request->except(['_token']);

        DB::beginTransaction();
        try {
            UserInfo::registUserInfo($values);
            DB::commit();
        } catch(Exception $e){
            DB::rollBack();
            Library::redirectWithErrors('myPageEdit', $e->getMessage());
        }

        return redirect('/mypage/userinfo/');
    }

    public function profile($userId)
    {
        $param = $this->getUserInfo($userId);
        $param = $param + ['userId' => $userId];
        return view('mypages.profileIndex', $param);
    }

    public function tweetShow($userId)
    {
        $function = function ($query){
            $query->orderBy('updated_at', 'DESC');
        };
        
        $user = User::with(['tweets' => $function,'userInfo'])->orderBy('updated_at', 'DESC')->find($userId);
        return view('mypages.profileTweetShow', ['user' => $user]);
    }

    public function profileImage()
    {
        $param = $this->getUserInfo(Auth::user()->id);
        return view('myPages.profileImageEdit', $param);
    }

    public function profileImageDelete(Request $request)
    {
        // $user = User::with('userInfo')->find(Auth::user()->id);
        $userInfo = UserInfo::where('user_id', Auth::user()->id)->first();
        $route = 'profileImage';
        if (isset($userInfo->avatar_filename)){
            //ここにアバター画像削除の処理を記述する
            DB::beginTransaction();
            try {
                Storage::delete('public/avatar/'. $userInfo->avatar_filename);
                $userInfo->avatar_filename = null;
                $userInfo->save();
                DB::commit();
            } catch(Exception $e){
                DB::rollBack();
                Library::redirectWithErrors($route, $e->getMessage());
            }
            return redirect()->route($route)->with('success', '削除が完了しました。');
        } else {
            return redirect()->route($route)->with('success', 'アバターが登録されていません');
        }
    }

    public function profileImageStore(ProfileImageRequest $request)
    {
        $userId = Auth::user()->id;
        $userInfo = UserInfo::find($userId);
        $route = 'profileImage';

        DB::beginTransaction();
        try {
            if (isset($userInfo['avatar_filename'])){
                Storage::delete('public/avatar/'. $userInfo['avatar_filename']);
            }
            $filename = $request->file->store('public/avatar');
            UserInfo::updateOrCreate(['user_id' => $userId],['avatar_filename' => basename($filename)]);
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            Library::redirectWithErrors($route, $e->getMessage());
        }
        return redirect()->route($route)->with('success', ' 保存しました。');
    }
}
