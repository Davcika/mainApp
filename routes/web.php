<?php

use App\Models\Post;
use App\Models\Answer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnswerController;


Route::get('/', function () {
    $user_posts = [];
    $allposts = Post::all();
    $answers = Answer::all();
    $user = auth()->user();
    if($user){
        $karma = $user->posts()->withCount('likes')->get()->sum('likes_count') + $user->answer()->withCount('likes')->get()->sum('likes_count');
    }else{
        $karma = 0;
    }
    return view('regPage', ['posts' => $allposts, 'user' => $user, 'answer' => $answers, 'karma' => $karma]);

});

//user routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/profile/{user}', [UserController::class, 'profileLog']);
Route::get('/profile-page/{user}', [UserController::class, 'profilePage']);

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


