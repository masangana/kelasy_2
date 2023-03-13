<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ecole;
use App\Models\Personne;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function index (){
        $ecole = Ecole::firstOrFail();
        $personnels = User::where('role','!=' ,'parent')->where('role', '!=', 'eleve')->with('personne') ->get();
        $view = 'personnel';
        return view('admin.personnel.index',
            [
                'personnes' => $personnels,
                'ecole' => $ecole,
                'view' => $view,
            ]);
    }

    public function create (){
        $ecole = Ecole::firstOrFail();
        $roles = Role::where('nom','!=' ,'parent')->where('nom','!=' ,'eleve')->get();
        $classes = [];
        
        return view('admin.personnel.create', [
            'ecole' => $ecole,
            'roles' => $roles,
            'classes' => $classes,
        ]);
    }

    public function show ($personne){
        $ecole = Ecole::firstOrFail();
        $personne = Personne::where('id', '=', $personne)->with('user')->firstOrFail();
        return view('admin.personnel.show', [
            'ecole' => $ecole,
            'personne' => $personne,
        ]);
    }

}
