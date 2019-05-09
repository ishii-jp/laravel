<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Like;
use App\tweet;

class LikeController extends Controller
{
    public function store(Request $request)
    {
        $like = Like::create(['tweet_id' => $request->tweet_id, 'user_id' => Auth::user()->id, 'like' => $request->like]);
        return response()->json($like);
    }

    public function destroy(Request $request)
    {
        if ($request->like == 0){
            $like = Like::whereUserId(Auth::user()->id)->whereTweetId($request->tweet_id)->delete();
            return response()->json($like);
        }
    }

    public function show()
    {
        // $likes = Like::WhereUserId(Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        // N+1問題解決した記述
        $likes = Like::with('tweet.user')->WhereUserId(Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        // dd($likes);
        return view('likes.show', ['likes' => $likes]);
    }
    public function likeUserShow($tweetId)
    {
        // $likeUsers = Like::where('tweet_id', $tweetId)->get();
        // クエリースコープを用いた記述の仕方
        // $likeUsers = Like::WhereTweetId($tweetId)->get();

        $likeUsers = Tweet::with('likes.user')->find($tweetId);
        // dd($likeUsers);
        return view('likes.likeUserShow', ['likeUsers' => $likeUsers]);
    }
}
