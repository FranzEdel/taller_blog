<?php

namespace App\Http\Controllers\Web;


use App\Models\Post;
use App\Models\Category;
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

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->pluck('id')->first();
        $posts = Post::where('category_id',$category)->published()->paginate(5);
        return view('web.posts',['posts' => $posts]);
    }

    public function tag($slug)
    {
        $posts = Post::whereHas('tags', function($query) use($slug){
            $query->where('slug',$slug);
        })->published()->paginate(5);
        return view('web.posts',['posts' => $posts]);
    }
}
