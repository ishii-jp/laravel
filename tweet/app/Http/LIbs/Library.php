<?php
namespace App\Libs;

// use DB;
use Illuminate\Support\MessageBag;
use Redirect;
use App\Like;

class Library
{
    // エラーメッセージと一緒にリダイレクトします。
    static function redirectWithErrors($route, $message)
    {
        $messages = new MessageBag;
        $messages->add('exception_message', 'エラーメッセージ：'.$message);
        Redirect::route($route)->withErrors($messages)->throwResponse();
    }

    // いいね数をカウントします
    static function likeCount($tweet_id)
    {
        $likeCount = Like::where('tweet_id', $tweet_id)->count();
        return $likeCount;
    }

}