<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function getUsers(Request $request)
    {
        return datatables()->of(User::all())
            ->addColumn('actions', function($user){
                $actionBtn = '
                    <a href="'. route('admin.users.show',$user->id) .'" class="btn btn-xs btn-default" title="Ver"><i class="fa fa-eye"></i></a>
                    <a href="'. route('admin.users.edit',$user->id) .'" class="btn btn-xs btn-info" title="Editar"><i class="fa fa-pencil-alt"></i></a>
                    <button type="submit" onclick="eliminar('.$user->id.')" class="btn btn-xs btn-danger" title="Eliminar"><i class="fa fa-times"></i></button>
 
                ';
                return $actionBtn;
            })
            ->addColumn('roles', function($user){
                return $user->getRoleNames()->implode(', ');
            })
            ->rawColumns(['actions'])
            ->toJson(); 
    }
}
