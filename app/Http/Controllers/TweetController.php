<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;

class TweetController extends Controller
{
    public function showTimelinePage(){

        $tweets = Tweet::latest()->get();
        return view('layouts.timeline', compact('tweets'));
    }

    public function postTweet(Request $request){
        
        // 簡易バリデーション
        $request->validate([
            'tweet' => 'required|string|max:280',
        ]);

        Tweet::create([
            'user_id' => 1,
            'tweet' => $request->tweet,
        ]);

        return redirect()->route('layouts.timeline');
    }
}
