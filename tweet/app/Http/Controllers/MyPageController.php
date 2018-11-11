<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPageController extends Controller
{
    public function index(){
        $user = Auth::user();
        return view('myPages.index', ['user' => $user]);
    }
}
