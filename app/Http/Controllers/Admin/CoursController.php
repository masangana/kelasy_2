<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
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
            'max_examen' => 'required',
            'max_periode' => 'required',
        ]);

        $ecole = Ecole::firstOrFail();
        
        Cours::create(
            [
                'nom' => $request->get('nom'),
                'slug' => $request->get('slug'),
                'description' => $request->get('description'),
                'maximum' => $request->get('maximum'),
                'classe_id' => $request->get('classe'),
                'max_examen' => $request->get('max_examen'),
                'max_periode' => $request->get('max_periode'),
            ]
        );

        return redirect()->route('cours.index')->with('success', 'Cours créé. Ajoutez un autre');
    }

    public function add_prof(Request $request)
    {
        //return $request->all();
        $request->validate([
            'professeur' => 'required',
        ]);

        //return $request->all();
        $annee = AnneeScolaire::where('active', true)->firstOrFail();
        $cours = Cours::with('professeurs')->findOrFail($request->get('cours'));
        if ($cours->professeurs->count() > 0) {
            return redirect()->route('classes.show', $request->get('classe'))->with('success', 'Professeur ajouté au cours');
        } else {
            $cours->professeurs()->attach($request->get('professeur'), 
            [
                'annee_scolaire_id' => $annee->id,
            ]);
            return redirect()->route('classes.show', $request->get('classe'))->with('success', 'Professeur ajouté au cours');
        }
               
    }
}
