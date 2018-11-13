<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Events\Logined;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    protected $redirectTo = '/tweet';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * ログイン認証後の処理
     * @param Request $request
     * @param $user
     */
    protected function authenticated(Request $request, $user)
    {
        // ログインイベントを起動させ、最終ログイン日時を入力する
        // event(new Logined());
        // なぜかイベントリスナーを使ったやり方だと値がテーブルに格納されないのでコントローラに直で書いたら最終ログイン日時が入力できました。
        $user->last_login_at = now();
        $user->save();
    }
}
