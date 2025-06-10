<?php

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    $user_posts = [];
    $allposts = Post::all();
    $user = auth()->user();
    if(Auth::check()){
        $user_posts = auth()->user()->avaibleFunctions()->get();
        foreach($user_posts as $user_post){
            $user['karma'] += $user_post['likes'];
        }
    }
    return view('regPage', ['posts' => $allposts, 'user' => $user]);
});

//user routes
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);

//post routes
Route::post('/create-post', [PostController::class, 'createPost']);
Route::post('/like', [PostController::class, 'likePost']);
Route::post('/dislike', [PostController::class, 'dislikePost']);