<?php

namespace App;

use App\Features;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    public function features()
    {
        return $this->belongsTo(Features::class);
    }

}
