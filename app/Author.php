<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

    protected $fillable = ['name'];

    // public function posts()
    // {
    //     return $this->hasMany(Post::class);
    // }

}
