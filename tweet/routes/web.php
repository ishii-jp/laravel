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

// Route::get('/', function () {
//     return view('welcome');
// });

// resourceで記述するとgetで同じルーティングを書いても反映されないっぽい？
// Route::get('tweet', 'TweetsController@index')->middleware('auth');

// ホーム画面
Route::get('/', 'HomeController@index')->name('home');

// グループ化したルーティング
Route::middleware('auth')->group(function(){
    Route::resource('tweet', 'TweetsController');
    // マイページ
    Route::get('/mypage', 'MyPageController@index')->name('myPage');
    Route::get('/mypage/userinfo', 'MyPageController@userInfo');
    Route::get('/mypage/edit', 'MyPageController@edit')->name('myPageEdit');
    Route::post('/mypage/store', 'MyPageController@store');
    Route::get('/mypage/passwordEdit', 'MyPageController@passwordEdit')->name('passwordEdit');
    Route::post('/mypage/passwordStore', 'MyPageController@passwordStore');
    Route::get('/mypage/profile/image', 'MyPageController@profileImage')->name('profileImage');
    Route::delete('/mypage/profile/imageDelete', 'MyPageController@profileImageDelete')->name('profileImageDelete');
    Route::post('/mypage/profile/image', 'MyPageController@ProfileImageStore')->name('profileImageStore');
    Route::get('/mypage/profile/{userId}', 'MyPageController@profile')->name('profile');
});




// ユーザー認証のルーティング
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// ログアウト
Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});
