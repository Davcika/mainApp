<?php

use App\Models\Post;
use App\Models\Answer;
use App\Models\Background;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\BackgroundController;

Route::get('/', function () {
    $user_posts = [];
    $allposts = Post::all();
    $answers = Answer::all();
    $user = auth()->user();
    return view('regPage', ['posts' => $allposts, 'user' => $user, 'answer' => $answers]);

});

//user routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/profile/{user}', [UserController::class, 'profileLog']);
Route::get('/profile-page/{user}', [UserController::class, 'profilePage']);
Route::get('/exit', [UserController::class, 'exit']);

//post routes
Route::post('/create-post', [PostController::class, 'createPost']);
Route::get('/edit-post/{post}', [PostController::class, 'showEditPost']);
Route::put('/edit-post/{post}', [PostController::class, 'editPost']);
Route::post('/like', [LikeController::class, 'likePost']);
Route::post('/dislike', [PostController::class, 'dislikePost']);
Route::delete('/delete-post/{post}', [PostController::class, 'deletePost']);

//answer routes
Route::get('/answer-post/{post}', [PostController::class, 'answerPage']);
Route::post('/create-answer', [AnswerController::class, 'createAnswer']);

//background routes
Route::post('/set-background', [UserController::class, 'setBackground']);

