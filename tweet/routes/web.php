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

// ホーム画面
Route::get('/', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function(){
    // ツイート機能
    Route::resource('tweet', 'TweetsController');
    // マイページ機能
    Route::prefix('mypage')->group(function(){
        Route::get('', 'MyPageController@index')->name('myPage');
        Route::get('userinfo', 'MyPageController@userInfo');
        Route::get('edit', 'MyPageController@edit')->name('myPageEdit');
        Route::post('store', 'MyPageController@store');
        Route::get('passwordEdit', 'MyPageController@passwordEdit')->name('passwordEdit');
        Route::post('passwordStore', 'MyPageController@passwordStore');
        Route::get('profile/image', 'MyPageController@profileImage')->name('profileImage');
        Route::delete('profile/imageDelete', 'MyPageController@profileImageDelete')->name('profileImageDelete');
        Route::post('profile/image', 'MyPageController@ProfileImageStore')->name('profileImageStore');
        Route::get('profile/{userId}', 'MyPageController@profile')->name('profile');
        Route::get('profile/tweet/{userId}', 'MyPageController@tweetShow')->name('tweetShow');
    });
    // 返信機能
    Route::prefix('reply')->group(function(){
        Route::get('{tweetId}', 'ReplyController@replyCreate')->name('replyCreate');
        Route::post('store/{tweetId}', 'ReplyController@replyStore')->name('replyStore');
        Route::get('show/{tweetId}', 'ReplyController@replyShow')->name('replyShow');
    });
    // いいね機能
    Route::prefix('like')->group(function(){
        Route::post('', 'LikeController@store')->name('likeStore');
        Route::get('userShow/{tweetId}', 'LikeController@likeUserShow')->name('likeUserShow');
        Route::get('show', 'LikeController@show')->name('likeShow');
    });
});



// ユーザー認証のルーティング
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// ログアウト
Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});


// resourceで記述するとgetで同じルーティングを書いても反映されないっぽい？
// Route::get('tweet', 'TweetsController@index')->middleware('auth');

// グループ化したルーティング
// Route::middleware('auth')->group(function(){
//     Route::resource('tweet', 'TweetsController');
//     // マイページ
//     Route::get('/mypage', 'MyPageController@index')->name('myPage');
//     Route::get('/mypage/userinfo', 'MyPageController@userInfo');
//     Route::get('/mypage/edit', 'MyPageController@edit')->name('myPageEdit');
//     Route::post('/mypage/store', 'MyPageController@store');
//     Route::get('/mypage/passwordEdit', 'MyPageController@passwordEdit')->name('passwordEdit');
//     Route::post('/mypage/passwordStore', 'MyPageController@passwordStore');
//     Route::get('/mypage/profile/image', 'MyPageController@profileImage')->name('profileImage');
//     Route::delete('/mypage/profile/imageDelete', 'MyPageController@profileImageDelete')->name('profileImageDelete');
//     Route::post('/mypage/profile/image', 'MyPageController@ProfileImageStore')->name('profileImageStore');
//     Route::get('/mypage/profile/{userId}', 'MyPageController@profile')->name('profile');
//     Route::get('/mypage/profile/tweet/{userId}', 'MyPageController@tweetShow')->name('tweetShow');
//     Route::get('/reply/{tweetId}', 'ReplyController@replyCreate')->name('replyCreate');
//     Route::post('/reply/store/{tweetId}', 'ReplyController@replyStore')->name('replyStore');
//     Route::get('/reply/show/{tweetId}', 'ReplyController@replyShow')->name('replyShow');
//     Route::resource('like', 'LikeController', ['only' => ['store']]);
// });