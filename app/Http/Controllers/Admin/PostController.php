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
        return view('admin.posts.index');
    }

    public function getPosts(Request $request)
    {
        return datatables()->of(Post::all())
            ->addColumn('actions', function($post){
                $actionBtn = '
                    <a href="'. route('admin.posts.show',$post->id) .'" class="btn btn-xs btn-default" title="Ver"><i class="fa fa-eye"></i></a>
                    <a href="'. route('admin.posts.edit',$post->id) .'" class="btn btn-xs btn-info" title="Editar"><i class="fa fa-pencil-alt"></i></a>
                    <a href="javascript:void(0)" class="btn btn-xs btn-danger" title="Eliminar"><i class="fa fa-times"></i></a>
                ';
                return $actionBtn;
            })
            ->addColumn('category', function($post){
                return $post->category->name;
            })
            ->rawColumns(['actions'])
            ->toJson(); 
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.posts.show', compact('post'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        //dd($request->get('foto'));
        // validaciones
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'body' => 'required',
            'excerpt' => 'required',
            'category_id' => 'required',
            'user_id' => 'required',
            'tags' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = new Post();
        $post->name = $request->get('name');
        $post->slug = $request->get('slug');
        $post->body = $request->get('body');
        $post->excerpt = $request->get('excerpt');
        $post->published_at = Carbon::createFromFormat('d/m/Y',$request->get('published_at'))->format('Y-m-d');
        //$post->published_at = Carbon::parse($request->get('published_at'))->format('Y-m-d');
        $post->category_id = $request->get('category_id');
        $post->user_id = $request->get('user_id');
        
        $foto = $request->file('foto');
        $fotoNombre = time().'.'.$foto->extension();
        $foto->move(public_path('img'),$fotoNombre);
        $post->foto = $fotoNombre;
        
        
        $post->save();

        $post->tags()->attach($request->get('tags'));

        return back()->with('success', 'Publicacion registrada correctamente');
    }

    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post','categories', 'tags'));
    }

    public function update(Request $request)
    {
        //dd($request->get('foto'));
        // validaciones
        $this->validate($request, [
            'name' => 'required',
            'slug' => 'required',
            'body' => 'required',
            'excerpt' => 'required',

            'user_id' => 'required',

            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $post = new Post();
        $post->name = $request->get('name');
        $post->slug = $request->get('slug');
        $post->body = $request->get('body');
        $post->excerpt = $request->get('excerpt');
        $post->published_at = Carbon::createFromFormat('d/m/Y',$request->get('published_at'))->format('Y-m-d');
        //$post->published_at = Carbon::parse($request->get('published_at'))->format('Y-m-d');
        $post->category_id = $request->get('category_id');
        $post->user_id = $request->get('user_id');
        
        $foto = $request->file('foto');
        $fotoNombre = time().'.'.$foto->extension();
        $foto->move(public_path('img'),$fotoNombre);
        $post->foto = $fotoNombre;
        
        
        $post->update();

        $post->tags()->syng($request->get('tags'));

        return back()->with('success', 'Publicacion Actualizada correctamente');
    }
}
