<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::with('author')
                ->latest('updated_at')
                ->paginate(15);

        return view('posts', ['posts' => $posts]);
    }

}
