<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Tweet;

class TweetsController extends Controller
{
    public function index(){
        // この書き方でforeachなどで回すと回った分だけクエリーが発生し負荷となる。
        // $tweets = Tweet::orderBy('updated_at', 'DESC')->get();
        // リレーションを用いてコレクションを取得する書き方(N+1問題を解決)
        $tweets = Tweet::with('user')->orderBy('updated_at', 'DESC')->get();
        return view('tweets.index', ['tweets' => $tweets]);
    }

    public function create(Request $request)
    {
        return view('tweets.create');
    }

    public function store(Request $request)
    {
        Tweet::create(array('user_id' => Auth::user()->id, 'image' => $request->image, 'text' => $request->text));
        $user = Auth::user();
        return view('tweets.store', ['user' => $user]);
    }

    public function show($id, Request $request)
    {
        $user = Auth::user();
        // $tweets = Tweet::where('user_id',$id)->orderBy('updated_at','DESC')->get();
        // N+1問題対策
        $tweets = Tweet::with('user')->where('user_id', $id)->orderBy('updated_at', 'DESC')->get();
        return view('tweets.show', ['tweets' => $tweets, 'user' => $user]);
    }

    public function edit($id, Request $request)
    {
        $tweet = Tweet::where('id', $id)->first();
        return view('tweets.edit',['tweet' => $tweet]);
    }

    public function update($id, Request $request)
    {
        Tweet::find($id)->update(array('image' => $request->image, 'text' => $request->text));
        return view('tweets.update');
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        Tweet::destroy($id);
        return redirect("/tweet/$user_id");
    }
}
