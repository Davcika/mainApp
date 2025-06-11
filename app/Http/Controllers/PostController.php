<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function deletePost(Post $post){
        if(Auth::user()->id !== $post['user_id']){
            return redirect('/');
        }
        Post::where('id', $post->id)->delete();
        return redirect('/');
        
    }

    public function editPost(Post $post, Request $request) {
        if(Auth::user()->id !== $post['user_id']){
            return redirect('/');
        }

        $fields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        $fields['title'] = strip_tags($fields['title']);
        $fields['body'] = strip_tags($fields['body']);

        $post->update($fields);
        return redirect('/');
    }

    public function showEditPost(Post $post){
        if(Auth::user()->id !== $post['user_id']){
            return redirect('/');
        }
        return view('editPost', ['post' => $post]);
    }

    public function answerPage(Post $post){
        return view('answerPage', ['post' => $post]);
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
