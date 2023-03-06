<?php

namespace App\Http\Controllers\Prof;

use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Cote;
use App\Models\Cours;
use App\Models\GroupeCote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        DB::transaction(function() use ($request, $cours, $annee_scolaire, $classe){
            $groupe_cote = GroupeCote::create([
                'cours_id' => $request->get('cours_id'),
                'epreuve_id' => $request->get('epreuve'),
                'periode_id' => $request->get('periode'),
                'annee_scolaire_id' => $annee_scolaire->id,
                'max' => $request->get('max'),
                'commentaire' => $request->get('commentaire'),
            ]);

            foreach($classe->eleves as $eleve){
                if($request->has($eleve->id)){
                    
                    Cote::create([
                        'eleve_id' => $eleve->id,
                        'cours_id' => $request->get('cours_id'),
                        'epreuve_id' => $request->get('epreuve'),
                        'max' => $request->get('max'),
                        'periode_id' => $request->get('periode'),
                        'groupe_cote_id' => $groupe_cote->id,
                        'annee_scolaire_id' => $annee_scolaire->id,
                        'cote' => $request->get($eleve->id),
                    ]);
                }
            }
        });
              
        return redirect()->route('cours_prof.show', $request->get('cours_id'))->with('success', 'Cotes enregistrées avec succès');
    }
}
