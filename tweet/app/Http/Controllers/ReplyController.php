<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TweetRequest;
use Illuminate\Http\Request;
use App\Reply;

class ReplyController extends Controller
{
    public function replyCreate($tweetId)
    {
//        ここにrepliesテーブルのデータを取得する処理を書く。
        return view('tweets.create', ['tweetId' => $tweetId]);
    }

    public function replyStore(TweetRequest $request, $tweetId)
    {
//        トライキャッチとトランザクションの処理を追記する。

        Reply::create([
            'tweet_id' => $tweetId,
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'text' => $request->text
        ]);

        return view('replies.replyComplete');
    }
}
