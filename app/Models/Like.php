<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable=['user_id', 'post_id', 'answer_id'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }

    public function answer(){
        return $this->belongsTo(Answer::class);
    }
}
