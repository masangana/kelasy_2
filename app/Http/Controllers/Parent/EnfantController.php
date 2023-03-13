<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Classe_eleves;
use App\Models\Scolarite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EnfantController extends Controller
{
    public function index()
    {
        return view('parent.enfant.index');
    }

    public function show($id)
    {
        /*Part for menu*/
        $parent = User::with('personne', 'aDesEnfants')
                ->find(Auth::user()->id);
        /** Fin */
        $isPupil = Classe_eleves::with('classe', 'eleve', 'anneeScolaire')->findOrFail($id);
        $enfant = User::with('personne')->findOrFail($isPupil->user_id);

        $classe = Classe::with(['cours' => function ($q){
                    $q->with(['archivedPeriode', 'professeurs'=> function ($q){
                        $q->with('personne');
                    }]);
        }])->findOrFail($isPupil->classe_id);
        
        $scolarite = Scolarite::where('classe_id', $isPupil->classe_id)
                    ->where('annee_scolaire_id', $isPupil->annee_scolaire_id)->first();
        
        
        //return $isPupil;
        return view('parent.enfant.show', [
            'enfant' => $enfant,
            'classe' => $classe,
            'parent' => $parent,
            'scolarite' => $scolarite,
            'isPupil' => $isPupil,
        ]);
    }
}
