<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function answerPage(Post $post){
        return view('answerPage', ['post' => $post]);
    }

    public function dislikePost(Request $request){
        $postId = $request->input('post_id');
        if(Post::where('id', $postId)->exists()){
            Post::where('id', $postId)->decrement('likes');
        }
        return redirect('/');
    }

    public function likePost(Request $request){
        $postId = $request->input('post_id');
        if(Post::where('id', $postId)->exists()){
            Post::where('id', $postId)->increment('likes');
        }
        return redirect('/');
    }

    public function createPost(Request $request){
        $fields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $fields['title'] = strip_tags($fields['title']);
        $fields['body'] = strip_tags($fields['body']);
        $fields['user_id'] = Auth::id();
        Post::create($fields);
        return redirect('/');

    }
}
