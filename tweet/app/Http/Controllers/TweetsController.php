<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Tweet;
use App\TweetImage;
use DB;
use App\Libs\Library;
use App\Http\Requests\ProfileImageRequest;
use App\Http\Requests\TweetRequest;
// 例外処理テスト用
// use Exception;
// throw new Exception('ツイート投稿エラー');

class TweetsController extends Controller
{
    public function index(Request $request){
        // ログインしているユーザーのいいねを取得
        $function = function ($query){
            $query->where('user_id', Auth::user()->id);
        };

        // いいね数順のランキングを取得
        // $param['likesRanking'] = DB::table('likes')->select(DB::raw('count(*) as user_count, tweet_id'))->groupBy('tweet_id')->orderBy('user_count', 'DESC')->limit(5)->get();
        $param['likesRanking'] = Tweet::likesRanking();

        // ツイート検索が行われたら結果を一緒に返す
        if(!empty($request->searchText)){
            $param['searchText'] = $request->searchText;
            $param['tweets'] = $this->search($function, $param['searchText']);
            // dd($param);
        } else {
            // トップ画面で必要な情報を全て取得
            $param['tweets'] = Tweet::with(['user', 'tweetImages', 'replies', 'likes' => $function])->orderBy('updated_at', 'DESC')->withCount('likes')->paginate(10);
        }

        return view('tweets.index', $param);
    }

    public function create(Request $request)
    {
        return view('tweets.create');
    }

    public function store(TweetRequest $request)
    {
        $user = Auth::user();
        $images = $request->image;
        $createArr =['user_id' => $user->id, 'title' => $request->title, 'text' => $request->text];

        DB::beginTransaction();
        try {
            $tweetCreateReault = Tweet::create($createArr);

            if (isset($images)){
                TweetImage::registImage($images, $tweetCreateReault);
            }
            DB::commit();
        } catch(Exception $e){
            DB::rollBack();
            Library::redirectWithErrors('tweet.create', $e->getMessage());
        }
        
        return view('tweets.store', ['user' => $user]);
    }

    public function show($id, Request $request)
    {
        $user = Auth::user();
        // $tweets = Tweet::where('user_id',$id)->orderBy('updated_at','DESC')->get();
        // N+1問題対策
        $tweets = Tweet::with('user', 'tweetImages')->where('user_id', $id)->orderBy('updated_at', 'DESC')->paginate(10);
        return view('tweets.show', ['tweets' => $tweets, 'user' => $user]);
    }

    public function edit($id, Request $request)
    {
        $tweet = Tweet::where('id', $id)->first();
        return view('tweets.edit',['tweet' => $tweet]);
    }

    public function update($tweetId, Request $request)
    {
        $images = $request->image;

        DB::beginTransaction();
        try{
            if (isset($images)){
                TweetImage::updateImage($images, $tweetId);
            }
    
            Tweet::find($tweetId)->update(['title' => $request->title, 'text' => $request->text]);
            DB::commit();
        } catch(Exception $e){
            DB::rollBack();
            Library::redirectWithErrors('tweet.edit', $e->getMessage());
        }
        
        return view('tweets.update');
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        DB::beginTransaction();
        try {
            Tweet::destroy($id);
            DB::commit();
        } catch(Exception $e){
            DB::rollBack();
            Library::redirectWithErrors('myPage', $e->getMessage());
        }
        
        return redirect("/tweet/$user_id");
    }

    public function search($function, $searchText)
    {
        return Tweet::tweetSearch($function, $searchText);
    }
}
