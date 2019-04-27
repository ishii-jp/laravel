<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Like;

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
            $like = Like::where('user_id', Auth::user()->id)->where('tweet_id', $request->tweet_id)->delete();
            return response()->json($like);
        }
    }

    public function likeUserShow($tweetId)
    {
        $likeUsers = Like::where('tweet_id', $tweetId)->get();
        // dd($likeUsers);
        return view('likes.likeUserShow', ['likeUsers' => $likeUsers]);
    }
}
