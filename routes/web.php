<?php

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnswerController;
use App\Models\Answer;

Route::get('/', function () {
    $user_posts = [];
    $allposts = Post::all();
    $answers = Answer::all();
    $user = auth()->user();
    if(Auth::check()){
        $user_posts = auth()->user()->posts()->get();
        foreach($user_posts as $user_post){
            $user['karma'] += $user_post['likes'];
        }
    }
    return view('regPage', ['posts' => $allposts, 'user' => $user, 'answer' => $answers]);
});

//user routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/profile/{user}', [UserController::class, 'profile']);

//post routes
Route::post('/create-post', [PostController::class, 'createPost']);
Route::post('/like', [PostController::class, 'likePost']);
Route::post('/dislike', [PostController::class, 'dislikePost']);

//answer routes
Route::get('/answer-post/{post}', [PostController::class, 'answerPage']);
Route::post('/create-answer', [AnswerController::class, 'createAnswer']);


