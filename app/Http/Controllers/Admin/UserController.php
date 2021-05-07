<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin.users.index')->only('index');
        $this->middleware('can:admin.users.show')->only('show');
        $this->middleware('can:admin.users.create')->only('create','store');
        $this->middleware('can:admin.users.edit')->only('edit','update');
        $this->middleware('can:admin.users.destroy')->only('destroy');
    }

    public function index()
    {
        return view('admin.users.index');
    }

    public function getUsers(Request $request)
    {
        return datatables()->of(User::all())
            ->addColumn('actions', function($user){
                
                $actionBtn = '';

                if(auth()->user()->can('admin.users.show'))
                {
                    $actionBtn = $actionBtn . '<a href="'. route('admin.users.show',$user->id) .'" class="btn btn-xs btn-default" title="Ver"><i class="fa fa-eye"></i></a>';
                }

                if(auth()->user()->can('admin.users.edit'))
                {
                    $actionBtn = $actionBtn . '<a href="'. route('admin.users.edit',$user->id) .'" class="btn btn-xs btn-info" title="Editar"><i class="fa fa-pencil-alt"></i></a>';
                }

                if(auth()->user()->can('admin.users.destroy'))
                {
                    $actionBtn = $actionBtn . '<button type="submit" onclick="eliminar('.$user->id.')" class="btn btn-xs btn-danger" title="Eliminar"><i class="fa fa-times"></i></button>';
                }

                return $actionBtn;
            })
            ->addColumn('roles', function($user){
                return $user->getRoleNames()->implode(', ');
            })
            ->rawColumns(['actions'])
            ->toJson(); 
    }

    public function create()
    {
        $roles = Role::pluck('name','id');

        return view('admin.users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $data = $request->validate([
            'name' => 'required|max:255',
            'email'  => ['required','email','max:255','unique:users'],
            'password' => ['confirmed', 'min:6'],
        ]);

        $user = User::create($data);
        
        if($request->filled('roles'))
        {
            $user->assignRole($request->roles);
        }

        return redirect()->route('admin.users.index')->with('success', 'Usuario registrado correctamente');

    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name','id');

        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        //return $request;
        $user = User::find($id);

        $rules = [
            'name'  => 'required',
            'email'  => ['required','email'],
        ];

        if($request->filled('password'))
        {
            $rules['password'] = ['confirmed', 'min:6'];
        }

        $data = $request->validate( $rules);


        $user->update($data);
        $user->syncRoles($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'Datos del Usuario Actualizados correctamente');

    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return response()->json(['status' => 'Usuario eliminado correctamente']);

    }
}
