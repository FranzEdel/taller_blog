<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.posts.index')->only('index');
        $this->middleware('can:admin.posts.show')->only('show');
        $this->middleware('can:admin.posts.create')->only('create','store');
        $this->middleware('can:admin.posts.edit')->only('edit','update');
        $this->middleware('can:admin.posts.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.posts.index');
    }

    public function getPosts(Request $request)
    {
        return datatables()->of(Post::all())
            ->addColumn('actions', function($post){
                
                $actionBtn = '';

                if(auth()->user()->can('admin.posts.show'))
                {
                    $actionBtn = $actionBtn . '<a href="'. route('admin.posts.show',$post->id) .'" class="btn btn-xs btn-default" title="Ver"><i class="fa fa-eye"></i></a>';
                }

                if(auth()->user()->can('admin.posts.edit'))
                {
                    $actionBtn = $actionBtn . '<a href="'. route('admin.posts.edit',$post->id) .'" class="btn btn-xs btn-info" title="Editar"><i class="fa fa-pencil-alt"></i></a>';
                }

                if(auth()->user()->can('admin.posts.destroy'))
                {
                    $actionBtn = $actionBtn . '<button type="submit" onclick="eliminar('.$post->id.')" class="btn btn-xs btn-danger" title="Eliminar"><i class="fa fa-times"></i></button>';
                }
        

                /* $actionBtn = '

                    <a href="'. route('admin.posts.show',$post->id) .'" class="btn btn-xs btn-default" title="Ver"><i class="fa fa-eye"></i></a>

                    <a href="'. route('admin.posts.edit',$post->id) .'" class="btn btn-xs btn-info" title="Editar"><i class="fa fa-pencil-alt"></i></a>
                    
                    <button type="submit" onclick="eliminar('.$post->id.')" class="btn btn-xs btn-danger" title="Eliminar"><i class="fa fa-times"></i></button>
 
                '; */
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

    public function store(PostStoreRequest $request)
    {
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

    public function update(PostUpdateRequest $request, $id)
    {
        $post = Post::find($id);
        //return $post->foto;
        $post->name = $request->get('name');
        $post->slug = $request->get('slug');
        $post->body = $request->get('body');
        $post->excerpt = $request->get('excerpt');
        $post->published_at = Carbon::createFromFormat('d/m/Y',$request->get('published_at'))->format('Y-m-d');
        //$post->published_at = Carbon::parse($request->get('published_at'))->format('Y-m-d');
        $post->category_id = $request->get('category_id');
        $post->user_id = $request->get('user_id');
        
        if($request->hasFile('foto'))
        {
            File::delete(public_path('img/').$post->foto);
            $foto = $request->file('foto');
            $fotoNombre = time().'.'.$foto->extension();
            $foto->move(public_path('img'),$fotoNombre);
            $post->foto = $fotoNombre;
        }
        
        $post->save();

        $post->tags()->sync($request->get('tags'));

        return redirect()->route('admin.posts.index')->with('success', 'Publicacion Actualizada correctamente');
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if(File::exists(public_path('img/').$post->foto))
        {
            File::delete(public_path('img/').$post->foto);
        }

        $post->delete();

        return response()->json(['status' => 'Post eliminado correctamente']);

    }
}
