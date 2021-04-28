<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        return view('admin.roles.index');
    }

    public function getRoles(Request $request)
    {
        return datatables()->of(Role::all())
            ->addColumn('actions', function($role){
                $actionBtn = '
                    <a href="'. route('admin.roles.show',$role->id) .'" class="btn btn-xs btn-default" title="Ver"><i class="fa fa-eye"></i></a>
                    <a href="'. route('admin.roles.edit',$role->id) .'" class="btn btn-xs btn-info" title="Editar"><i class="fa fa-pencil-alt"></i></a>
                    <button type="submit" onclick="eliminar('.$role->id.')" class="btn btn-xs btn-danger" title="Eliminar"><i class="fa fa-times"></i></button>
 
                ';
                return $actionBtn;
            })
            ->rawColumns(['actions'])
            ->toJson(); 
    }

    public function show($id)
    {
        $role = Role::find($id);
        return view('admin.roles.show', compact('role'));
    }

    public function create()
    {
        $permissions = Permission::pluck('name','id');
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        //dd($request->all());

        $role = Role::create($request->all());

        $role->syncPermissions($request->permissions);

        return back()->with('success', 'Rol registrado correctamente');
    }

    public function edit($id)
    {
        $permissions = Permission::pluck('name','id');
        $role = Role::find($id);

        return view('admin.roles.edit', compact('role','permissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::find($id);

        $rules = [
            'name'  => 'required',
        ];

        $data = $request->validate( $rules);

        $role->update($data);

        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Roles y Permisos Actualizados correctamente');
    }

    public function destroy($id)
    {
        Role::find($id)->delete($id);

        return response()->json(['status' => 'Categoria eliminada correctamente']);

    }
}
