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
        // ログインユーザー情報を取得
        $userId = Auth::user()->id;
        // いいねされたツイートIDを取得
        $tweetId = $request->tweet_id;
        // いいねを押したツイートをすでにいいねしているか判定
        $userLike = Like::whereUserId($userId)->whereTweetId($tweetId)->first();

        if (empty($userLike)){
            // いいね登録処理
            Like::likeCreate($tweetId, $userId, $request->like);
        } else {
            // いいね削除する処理
            $like = Like::likeDelete($userId, $tweetId);
        }
        // いいね数をカウント
        $likesCount = Like::likesCount($tweetId);

        return response()->json($likesCount);
    }

    public function show()
    {
        // $likes = Like::WhereUserId(Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        // N+1問題解決した記述
        $likes = Like::with('tweet.user')->WhereUserId(Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        return view('likes.show', ['likes' => $likes]);
    }
    public function likeUserShow($tweetId)
    {
        // $likeUsers = Like::where('tweet_id', $tweetId)->get();
        // クエリースコープを用いた記述の仕方
        // $likeUsers = Like::WhereTweetId($tweetId)->get();

        $likeUsers = Tweet::with('likes.user')->find($tweetId);
        return view('likes.likeUserShow', ['likeUsers' => $likeUsers]);
    }
}
