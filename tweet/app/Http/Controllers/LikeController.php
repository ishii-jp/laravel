<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;

class LikeController extends Controller
{
    public function store(Request $request){
        $like = Like::create(['tweet_id' => $request->tweet_id, 'like' => $request->like]);
        return response()->json($like);
    }
}
