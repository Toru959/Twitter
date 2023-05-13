<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;

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
            'user_id' => Auth::id(),
            'tweet' => $request->tweet,
        ]);

        return back();
    }

    public function destroy($id){

        // dd($id);
        $tweet = Tweet::find($id);
        $tweet->delete();

        return redirect()->route('timeline');
    }
}
