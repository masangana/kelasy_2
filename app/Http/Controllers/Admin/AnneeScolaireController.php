<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
use App\Models\Ecole;
use Illuminate\Http\Request;

class AnneeScolaireController extends Controller
{
    public function index (){

        $annees = AnneeScolaire::all();
        return view('admin.anneescolaire.index',
            [
                'annees' => $annees,
            ]);
    }

    public function create (){
        return view('admin.annee_scolaire.create');
    }

    public function store (Request $request){
        $request->validate([
            'nom' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
            'description' => 'nullable',
        ]);

        $ecole = Ecole::firstOrFail();
        AnneeScolaire::create(
            [
                'nom' => $request->get('nom'),
                'date_debut' => $request->get('date_debut'),
                'date_fin' => $request->get('date_fin'),
                'description' => $request->get('description'),
                'ecole_id' => $ecole->id,
            ]
        );

        return redirect()->route('annee_scolaire.index')->with('success', 'Année scolaire créée. Ajoutez une autre');
    }
}
