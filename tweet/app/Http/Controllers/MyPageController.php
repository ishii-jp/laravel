<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MyPageRequest;
use App\Http\Requests\MyPageEditRequest;
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
        $user = User::find($userId);
        $userInfo = UserInfo::where('user_id', $userId)->first();
        $param = ['user' => $user, 'userInfo' => $userInfo];
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
                    DB::commit();
                    $user->save();
                } catch (PDOException $e){
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
        // $user = $this->getUser();
        $userInfo = UserInfo::all();
        // 下記の書き方だとsqlエラー (Unknown column '_token')となってしまいました。
        // $values = $request->all();
        $values = $request->except(['_token']);
        UserInfo::updateOrCreate([
            'user_id' => $values['user_id'],
            'name' => $values['name'],
            'email' => $values['email']
        ],[
            'year' => $values['year'],
            'month' => $values['month'],
            'day' => $values['day'],
            'profile' => $values['profile'],
            'blood_type' => $values['blood_type'],
            'hobby' => $values['hobby'],
            'residence' => $values['residence'],
        ]);

        return redirect('/mypage/userinfo/');
    }

    public function profile($userId)
    {
        $param = $this->getUserInfo($userId);
        return view('mypages.profileIndex', $param);
    }

    public function profileImage()
    {
        $user = $this->getUser();
        return view('myPages.profileImageEdit', $user);
    }
}
