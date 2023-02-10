<?php

namespace App\Http\Controllers\Prof;

use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Cote;
use App\Models\Cours;
use Illuminate\Http\Request;

class CoteController extends Controller
{
    public function index() {
      return view('prof.cote');
    }

    public function show($id) {
        return view('prof.cote.show');
    }

    public function create() {
        return view('prof.cote.create');
    }

    public function store(Request $request) {

        $request->validate([
            'cours_id' => 'required',
            'epreuve' => 'required',
            'max' => 'required',
            'periode' => 'required',
        ]);

        $cours = Cours::findOrFail($request->get('cours_id'));
        $annee_scolaire = AnneeScolaire::where('active', true)->first();
        $classe = Classe::with('eleves')->findOrFail($cours->classe_id);

        foreach($classe->eleves as $eleve){
            if($request->has($eleve->id)){
                
                Cote::create([
                    'eleve_id' => $eleve->id,
                    'cours_id' => $request->get('cours_id'),
                    'epreuve_id' => $request->get('epreuve'),
                    'max' => $request->get('max'),
                    'periode_id' => $request->get('periode'),
                    'cote' => $request->get($eleve->id),
                    'annee_scolaire_id' => $annee_scolaire->id,
                    'commentaire' => $request->get('commentaire'),
                ]);
            }
        }
        
        return redirect()->route('cours_prof.show', $request->get('cours_id'))->with('success', 'Cotes enregistrées avec succès');
    }
}
