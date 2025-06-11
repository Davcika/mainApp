<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function likePost(Request $request){
        $user = Auth::user();
        $postId = $request->input('post_id');
        $answerId = $request->input('answer_id');
        
        $alreadyLiked = Like::where('user_id', $user->id)->where('post_id', $postId)->exists();
        if($alreadyLiked){
            return redirect('/');
        }

        Like::create(['user_id' => $user->id, 'post_id' => $postId, 'answer_id' => $answerId]);
        return redirect('/');
    }
}
