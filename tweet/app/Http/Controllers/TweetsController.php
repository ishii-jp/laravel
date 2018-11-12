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
        $user = Auth::user();
        $tweets = Tweet::where('user_id',$request->tweet)->orderBy('id','DESC')->get();
        return view('tweets.show', ['tweets' => $tweets, 'user' => $user]);
    }

    public function edit(Request $request){
        $tweet = Tweet::where('id', $request->tweet)->first();
        return view('tweets.edit',['tweet' => $tweet]);
    }

    public function update(Request $request){
        $tweet = Tweet::find($request->tweet);
        $tweet->image = $request->image;
        $tweet->text = $request->text;
        $tweet->save();
        return view('tweets.index');
    }
}
