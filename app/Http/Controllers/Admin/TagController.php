<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.tags.index')->only('index');
        $this->middleware('can:admin.tags.show')->only('show');
        $this->middleware('can:admin.tags.create')->only('create','store');
        $this->middleware('can:admin.tags.edit')->only('edit','update');
        $this->middleware('can:admin.tags.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.tags.index');
    }

    public function getTags(Request $request)
    {
        return datatables()->of(Tag::all())
            ->addColumn('actions', function($tag){
                
                $actionBtn = '';

                if(auth()->user()->can('admin.tags.edit'))
                {
                    $actionBtn = $actionBtn . '<a href="'. route('admin.tags.edit',$tag->id) .'" class="btn btn-xs btn-info" title="Editar"><i class="fa fa-pencil-alt"></i></a>';
                }

                if(auth()->user()->can('admin.tags.destroy'))
                {
                    $actionBtn = $actionBtn . '<button type="submit" onclick="eliminar('.$tag->id.')" class="btn btn-xs btn-danger" title="Eliminar"><i class="fa fa-times"></i></button>';
                }

                return $actionBtn;
            })
            ->rawColumns(['actions'])
            ->toJson(); 
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(TagStoreRequest $request)
    {
        $tag = new Tag();
        $tag->name = $request->get('name');
        $tag->slug = $request->get('slug');

        $tag->save();

        return back()->with('success', 'Etiqueta registrada correctamente');
    }

    public function edit($id)
    {
        $tag = Tag::find($id);

        return view('admin.tags.edit', compact('tag'));
    }

    public function update(TagUpdateRequest $request, $id)
    {
        $tag = Tag::find($id);
        //return $tag->foto;
        $tag->name = $request->get('name');
        $tag->slug = $request->get('slug');
       
        
        $tag->save();

        return redirect()->route('admin.tags.index')->with('success', 'Etiqueta Actualizada correctamente');
    }

    public function destroy($id)
    {
        Tag::find($id)->delete($id);

        return response()->json(['status' => 'Etiqueta eliminada correctamente']);

    }
}
