<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Cours;
use App\Models\Ecole;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    public function index (){
        $classes = Classe::all();
        $cours = Cours::with('classe')->get();
        return view('admin.cours.index',
            [
                'classes' => $classes,
                'cours' => $cours,
            ]);
    }

    public function create (){
        return view('admin.cours.create');
    }

    public function store (Request $request){
        $request->validate([
            'nom' => 'required',
            'slug' => 'required',
            'classe' => 'required',
            'maximum' => 'required',
            'description' => 'nullable',
        ]);

        $ecole = Ecole::firstOrFail();
        
        Cours::create(
            [
                'nom' => $request->get('nom'),
                'slug' => $request->get('slug'),
                'description' => $request->get('description'),
                'maximum' => $request->get('maximum'),
                'classe_id' => $request->get('classe'),
            ]
        );

        return redirect()->route('cours.index')->with('success', 'Cours créé. Ajoutez un autre');
    }
}
