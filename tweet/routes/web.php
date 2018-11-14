<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// resourceで記述するとgetで同じルーティングを書いても反映されないっぽい？
// Route::get('tweet', 'TweetsController@index')->middleware('auth');

// グループ化したルーティング
Route::middleware('auth')->group(function(){
    Route::resource('tweet', 'TweetsController');
});


// マイページ
Route::get('/mypage', 'MyPageController@index');

// ユーザー認証のルーティング
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// ログアウト
Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});
