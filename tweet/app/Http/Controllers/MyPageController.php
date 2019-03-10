<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MyPageRequest;
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
        $userInfo = UserInfo::find($userId);
        return $userInfo;
    }

    public function index()
    {
        $user = $this->getUser();
        return view('myPages.index', ['user' => $user]);
    }

    public function userInfo()
    {
        // $user = $this->getUser();
        // $userInfo = UserInfo::find($user->id);
        $user = $this->getUser();
        $userInfo = $this->getUserInfo($user->id);
        $param = ['user' => $user, 'userInfo' => $userInfo];
        return view('myPages.userInfo', $param);
    }

    public function edit()
    {
        $user = $this->getUser();
        $userInfo = UserInfo::find($user->id);
        $param = ['user' => $user, 'userInfo' => $userInfo];
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

    public function store(Request $request)
    {
        // $user = $this->getUser();
        $userInfo = UserInfo::all();
        // 下記の書き方だとsqlエラー (Unknown column '_token')となってしまいました。
        // $values = $request->all();
        $values = $request->except(['_token']);
        // dd($values);
        // if(!empty($values)){
            // $userInfo->$key = $value;
            // $userInfo->save();
            UserInfo::updateOrCreate([
                'user_id' => $values['user_id'],
                'name' => $values['name'],
                'email' => $values['email']
            ],[
                'profile' => $values['profile'],
                'blood_type' => $values['blood_type'],
                'hobby' => $values['hobby'],
                'residence' => $values['residence'],
            ]);
            // $user->name = $data['name'];
            // $user->email = $data['email'];
            // $user->save();
        // }

        return redirect('/mypage/userinfo/');
    }

    public function profile($userId)
    {
        // $user = $this->getUser();
        $userInfo = UserInfo::find($userId);
        return view('mypages.profileIndex', ['userInfo' => $userInfo]);
    }
}
