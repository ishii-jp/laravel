<?php

namespace App\Http\Controllers;

use App\Libs\Library;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\TweetRequest;
use Illuminate\Http\Request;
use App\Reply;
use App\User;
use App\Tweet;
use DB;

class ReplyController extends Controller
{
    public function replyCreate($tweetId)
    {
//        ここにrepliesテーブルのデータを取得する処理を書く。
        return view('tweets.create', ['tweetId' => $tweetId]);
    }

    public function replyStore(TweetRequest $request, $tweetId)
    {
        try {
            DB::beginTransaction();

            Reply::create([
                'tweet_id' => $tweetId,
                'user_id' => Auth::user()->id,
                'title' => $request->title,
                'text' => $request->text
            ]);

            DB::commit();
        } catch(Exception $e){
            DB::rollBack();
            Library::redirectWithErrors('tweet.create', $e->getMessage());
        }


        return view('replies.replyComplete');
    }

    public function replyShow($tweetId)
    {
        $tweets = Tweet::with(['replies', 'user'])->find($tweetId);
        return view('replies.replyShow', ['tweets' => $tweets]);
    }
}
