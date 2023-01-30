<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ecole;
use App\Models\Role;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function index (){
        return view('admin.personnel.index');
    }

    public function create (){
        $ecole = Ecole::firstOrFail();
        $roles = Role::where('nom','=' ,'prof')->orWhere('nom','=', 'admin')->get();
        //return $roles;
        
        return view('admin.personnel.create', [
            'ecole' => $ecole,
            'roles' => $roles,
        ]);
    }

}
