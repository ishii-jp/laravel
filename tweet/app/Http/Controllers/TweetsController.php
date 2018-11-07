<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class TweetsController extends Controller
{
    public function index(){
        return view('tweets.index');
    }
}
