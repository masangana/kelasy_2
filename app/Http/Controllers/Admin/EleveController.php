<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Eleve;
use App\Models\Personne;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EleveController extends Controller
{
    public function index (){
        
        $eleves = User::with('personne', 'isPupil')->where('role','eleve') ->get();
        $view = 'eleve';
        //return $eleves[4]->isPupil[0];
        return view('admin.eleve.index',
            [
                'personnes' => $eleves,
                'view' => $view,
            ]);
        //return view('admin.eleve.index');
    }

    public function create (){
        $classes = Classe::all();
        $roles = Role::where('nom', 'eleve')->get();
        //return $roles[0];
        return view('admin.eleve.create',
            [
                'roles' => $roles,
                'classes' => $classes,
            ]);
    }

}
