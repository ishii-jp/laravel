<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
    }

    public function store()
    {

    }
}
