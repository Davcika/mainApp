<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AnswerController extends Controller
{
    public function createAnswer(Request $request){
        $fields = $request->validate([
            'body' => 'required'
        ]);

        $fields['body'] = strip_tags($fields['body']);
        $fields['post_id'] = $request->input('post_id');
        $fields['user_id'] = Auth::id();
        Answer::create($fields);
        return redirect('/');
    }
}
