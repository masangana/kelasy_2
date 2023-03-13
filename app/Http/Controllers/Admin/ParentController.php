<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ecole;
use App\Models\EleveParent;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function index()
    {
        $ecole = Ecole::firstOrFail();
        $personnels = User::where('role', 'parent')->with('personne') ->get();
        $view = 'Parents';
        return view('admin.parent.index', [
            'personnes' => $personnels,
            'ecole' => $ecole,
            'view' => $view,
        ]);
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

    public function store(Request $request){
        //return $request->all();

        $request->validate([
            'parent' => 'required',
            'eleve' => 'required|unique:eleve_parents,eleve_id',
        ]);
        
        EleveParent::create([
            'eleve_id' => $request->get('eleve'),
            'parent_id' => $request->get('parent'),
        ]);

        return redirect()->back()->with('success', 'Parent créé. Ajoutez un autre');
    } 

    public function destroy($id){
        $lien = EleveParent::where('eleve_id', $id)->first();
        $lien->delete();
        return redirect()->back()->with('success', 'Lien supprimé');
    }

}
