<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MyPageRequest;
use Hash;

class MyPageController extends Controller
{
    public function getUser()
    {
        $user = Auth::user();
        return $user;
    }

    public function index()
    {
        $user = $this->getUser();
        return view('myPages.index', ['user' => $user]);
    }

    public function userInfo()
    {
        $user = $this->getUser();
        return view('myPages.userInfo', ['user' => $user]);
    }

    public function edit()
    {
        $user = $this->getUser();
        return view('myPages.edit', ['user' => $user]);
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
                $encrypted = Hash::make($request->password);
                $user->password = $encrypted;
                $user->save();
                return redirect('/mypage/userinfo/');
            } else {
                return redirect('/mypage/passwordEdit');
            }
        } else {
            return redirect('/mypage/passwordEdit')->with('msg', '現在のパスワードが誤っています。');
        }
    }

    public function store(Request $request)
    {
        $user = $this->getUser();
        $data = $request->all();
        // dd($data);
        if(isset($data)){
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->save();
        }

        return redirect('/mypage/userinfo/');
    }
}
