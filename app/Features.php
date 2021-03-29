<?php

namespace App;

use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
