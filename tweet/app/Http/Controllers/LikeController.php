<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Like;

class LikeController extends Controller
{
    public function store(Request $request){
        $like = Like::create(['tweet_id' => $request->tweet_id, 'user_id' => Auth::user()->id, 'like' => $request->like]);
        return response()->json($like);
    }
}
