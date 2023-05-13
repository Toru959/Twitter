<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;

class LikeController extends Controller
{
    public function store(Request $request){

        $like = new Like();
        $like->tweet_id = 1;
        $like->user_id = 1;
        $like->save();

        return redirect()->route('/timeline');
    }
}
