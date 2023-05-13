<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Request $request){

        // dd($request->tweet_id);

        $like = new Like();
        $like->tweet_id = $request->tweet_id;
        $like->user_id = Auth::id();
        $like->save();

        return redirect()->route('timeline');
    }

    public function destroy(Request $request){

        // dd($request->like_id);

        $like = Like::find($request->like_id);
        $like->delete();

        return redirect()->route('timeline');

    }
}
