<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        // validaciones
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'body' => 'required',
            'excerpt' => 'required',
            'published_at' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'tags' => 'required',
        ]);

        $post = new Post();
        $post->name = $request->get('name');
        $post->slug = $request->get('slug');
        $post->body = $request->get('body');
        $post->excerpt = $request->get('excerpt');
        $post->published_at = Carbon::parse($request->get('published_at'));
        $post->category_id = $request->get('category_id');
        $post->user_id = $request->get('user_id');
        $post->save();

        $post->tags()->attach($request->get('tags'));

        return back()->with('flash', 'Publicaciòn registrada correctamente');
    }
}
