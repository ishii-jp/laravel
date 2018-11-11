<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Tweet;

class TweetsController extends Controller
{
    public function index(Request $request){
        $tweets = Tweet::all();
        return view('tweets.index', ['tweets' => $tweets]);
    }

    public function create(Request $request){
        return view('tweets.create');
    }

    public function store(Request $request){
        Tweet::create(array('user_id' => Auth::user()->id, 'image' => $request->image, 'text' => $request->text));
        $user = Auth::user();
        return view('tweets.store', ['user' => $user]);
    }

    public function show (Request $request){
        if (Auth::check()){
            $user = Auth::user();
        }
        $tweets = Tweet::where('user_id',$request->tweet)->get();
        return view('tweets.show', ['tweets' => $tweets, 'user' => $user]);
    }
}
