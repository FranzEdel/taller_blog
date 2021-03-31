<?php

namespace App\Http\Controllers\Web;


use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function blog()
    {
        $posts = Post::published()->paginate(5);
        return view('web.posts',['posts' => $posts]);
    }

    public function show(Post $post)
    {
        return view('web.show', compact('post'));
    }
}
