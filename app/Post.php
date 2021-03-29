<?php

namespace App;

use App\Author;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = ['title', 'content', 'author_id'];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
}
