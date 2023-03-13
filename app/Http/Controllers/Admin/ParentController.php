<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ecole;
use App\Models\Role;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function index()
    {
        
        return view('admin.parent.index');
    }

    public function create()
    {
        $ecole = Ecole::firstOrFail();
        $roles = Role::where('nom','=' ,'parent')->get();
        $classes = [];
        return view('admin.parent.create', [
            'ecole' => $ecole,
            'roles' => $roles,
            'classes' => $classes,
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }
}
