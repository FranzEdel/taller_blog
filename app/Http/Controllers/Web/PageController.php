<?php

namespace App\Http\Controllers\Web;


use App\Models\Post;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function blog()
    {
        $posts = Post::orderBy('id', 'DESC')->where('status','PUBLISHED')->paginate(5);

        return view('web.posts',['posts' => $posts]);
    }
}
