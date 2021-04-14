<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index');
    }

    public function getCategories(Request $request)
    {
        return datatables()->of(Category::all())
            ->addColumn('actions', function($category){
                $actionBtn = '
                    <a href="'. route('admin.categories.show',$category->id) .'" class="btn btn-xs btn-default" title="Ver"><i class="fa fa-eye"></i></a>
                    <a href="'. route('admin.categories.edit',$category->id) .'" class="btn btn-xs btn-info" title="Editar"><i class="fa fa-pencil-alt"></i></a>
                    <button type="submit" onclick="eliminar('.$category->id.')" class="btn btn-xs btn-danger" title="Eliminar"><i class="fa fa-times"></i></button>
 
                ';
                return $actionBtn;
            })
            ->rawColumns(['actions'])
            ->toJson(); 
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('admin.categories.show', compact('category'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $category = new Category();
        $category->name = $request->get('name');
        $category->slug = $request->get('slug');
        $category->body = $request->get('body');

        $category->save();

        return back()->with('success', 'Categoria registrada correctamente');
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        $category = Category::find($id);
        //return $category->foto;
        $category->name = $request->get('name');
        $category->slug = $request->get('slug');
        $category->body = $request->get('body');
        
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Categoria Actualizada correctamente');
    }

    public function destroy($id)
    {
        Category::find($id)->delete($id);

        return response()->json(['status' => 'Categoria eliminada correctamente']);

    }
}