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
        $param = $this->getUserInfo(Auth::user()->id);
        return view('myPages.userInfo', $param);
    }

    public function edit()
    {
        $param = $this->getUserInfo(Auth::user()->id);
        return view('myPages.edit', $param);
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
        return view('mypages.profileIndex', $param);
    }

    public function profileImage()
    {
        $param = $this->getUserInfo(Auth::user()->id);
        return view('myPages.profileImageEdit', $param);
    }

    public function profileImageStore(ProfileImageRequest $request)
    {
        $userId = Auth::user()->id;
        $param = $this->getUserInfo($userId);

        $filename = $request->file->store('public/avatar');

        DB::beginTransaction();
        try {
            if (is_null($param['userInfo'])){
                UserInfo::create(['avatar_filename' => basename($filename), 'user_id' => $userId]);
            } else {
                $param['userInfo']->avatar_filename = basename($filename);
                $param['userInfo']->save();
            }
            $param['success'] = '保存しました';
            DB::commit();
        } catch(Exception $e) {
            DB::rollBack();
            Library::redirectWithErrors('profileImage', $e->getMessage());
        }
        
        return view('myPages.profileImageEdit', $param);
        
    }
}
