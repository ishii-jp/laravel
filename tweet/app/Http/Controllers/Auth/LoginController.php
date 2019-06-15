<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Events\Logined;
use Validator;

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

    public function username(){
        return 'name';
    }
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

    public function login(Request $request)
    {
        // ログイン認証に必要な情報を取得
        $authInfo = [
            'name' => $request->name,
            'password' => $request->password
        ];

        // バリデーションのルールを定義
        $rules = [
            'name' => 'required|string',
            'password' => 'required|string'
        ];

        // エラーメッセージを定義
        $messages = [
            'name.requird' => '名前を入力して下さい',
            'name.string' => '名前に数字や記号は使えません。',
            'password.required' => 'パスワードを入力して下さい。',
            'password.string' => 'パスワードに数字や記号は使えません。'
        ];

        $validator = Validator::make($authInfo, $rules, $messages);

        if ($validator->fails()){
            return redirect(route('login'))->withErrors($validator)->withInput();
        }

        // 認証
        if ($this->guard()->attempt($authInfo)){
            return redirect(route('tweet.index'));
        } else {
            $validator->errors()->add('password', 'ログインに失敗しました。');
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }
}
