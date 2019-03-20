<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Tweet;
use App\TweetImage;
use DB;
use App\Libs\Library;
use App\Http\Requests\ProfileImageRequest;
use App\Http\Requests\TweetImageRequest;

class TweetsController extends Controller
{
    public function index(){
        // この書き方でforeachなどで回すと回った分だけクエリーが発生し負荷となる。
        // $tweets = Tweet::orderBy('updated_at', 'DESC')->get();
        // リレーションを用いてコレクションを取得する書き方(N+1問題を解決)
        $tweets = Tweet::with('user', 'tweetImages')->orderBy('updated_at', 'DESC')->get();
        return view('tweets.index', ['tweets' => $tweets]);
    }

    public function create(Request $request)
    {
        return view('tweets.create');
    }

    public function store(TweetImageRequest $request)
    {
        $user = Auth::user();
        $images = $request->image;
        $createArr =['user_id' => $user->id, 'title' => $request->title, 'text' => $request->text];

        $tweetCreateReault = Tweet::create($createArr);

        if (isset($images)){
            foreach ($images as $image){
                // dd($tweetCreateReault);
                $filename = $image->store('public/avatar');
                TweetImage::create(['tweet_id' => $tweetCreateReault->id, 'image' => basename($filename)]);
            }
        }

        
        return view('tweets.store', ['user' => $user]);
    }

    public function show($id, Request $request)
    {
        $user = Auth::user();
        // $tweets = Tweet::where('user_id',$id)->orderBy('updated_at','DESC')->get();
        // N+1問題対策
        $tweets = Tweet::with('user')->where('user_id', $id)->orderBy('updated_at', 'DESC')->get();
        return view('tweets.show', ['tweets' => $tweets, 'user' => $user]);
    }

    public function edit($id, Request $request)
    {
        $tweet = Tweet::where('id', $id)->first();
        return view('tweets.edit',['tweet' => $tweet]);
    }

    public function update($tweet, Request $request)
    {
        $image = $request->image;
        $updateArr = ['title' => $request->title, 'text' => $request->text];

        DB::beginTransaction();
        try{
            if (isset($image)){
                $filename = $image->store('public/avatar');
                $updateArr = array_merge($updateArr,['image' => $filename]);
            }
    
            Tweet::find($tweet)->update($updateArr);
            DB::commit();
        } catch(PDOException $e){
            DB::rollBack();
            Library::redirectWithErrors("/tweet/$tweet/edit", $e->getMessage());
        }
        
        return view('tweets.update');
    }

    public function destroy($id)
    {
        $user_id = Auth::user()->id;
        Tweet::destroy($id);
        return redirect("/tweet/$user_id");
    }
}




// public function store(TweetImageRequest $request)
//     {
//         $user = Auth::user();
//         $image = $request->image;
//         $createArr =['user_id' => $user->id, 'title' => $request->title, 'text' => $request->text];

//         if (isset($image)){
//             $filename = $image->store('public/avatar');
//             $imageArr = ['image' => basename($filename)];
//             $createArr = array_merge($createArr, $imageArr);
//         }

//         Tweet::create($createArr);
//         return view('tweets.store', ['user' => $user]);
//     }
