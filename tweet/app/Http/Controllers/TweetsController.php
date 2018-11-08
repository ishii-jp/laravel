<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Tweet;

class TweetsController extends Controller
{
    public function index(){
        return view('tweets.index');
    }

    public function create(Request $request){
        return view('tweets.create');
    }

    public function store(Request $request){
        Tweet::create(array('user_id' => Auth::user()->id, 'image' => $request->image, 'text' => $request->text));
        return view('tweets.store');
    }
}
