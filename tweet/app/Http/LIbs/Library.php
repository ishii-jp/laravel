<?php
namespace App\Libs;

// use DB;
use MessageBag;
use Redirect;

class Library
{
    static function redirectWithErrors($route, $message)
    {
        $messages = new MessageBag;
        $messages->add('exception_message', 'エラーメッセージ：'.$message);
        Redirect::route($route)->withErrors($messages)->throwResponse();
    }

}