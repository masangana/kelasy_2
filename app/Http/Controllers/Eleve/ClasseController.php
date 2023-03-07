<?php

namespace App\Http\Controllers\Eleve;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Classe_eleves;
use App\Models\Epreuve;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClasseController extends Controller
{
    public function show($id) {

        $classe = Classe::with(['cours' => function ($q){
            $q->with(['archivedPeriode', 'professeurs'=> function ($q){
                $q->with('personne');
            }]);
        }])->findOrFail($id);

        $lesClasses = Classe_eleves::with('classe')
                    ->where('user_id', Auth::user()->id)->get();
        
        $eleve = User::with(['personne', 'hasCoteByCursus' => function ($q){
                        $q->with('epreuve', 'periode');
                    }, 'isPupil'])->findOrFail(Auth::user()->id);
        $epreuves = Epreuve::all();
        $periodes = Periode::all();
        //return $eleve;
        return view('eleve.classe.show', [
            'classe' => $classe,
            'eleve' => $eleve,
            'lesClasses' => $lesClasses,
            'epreuves' => $epreuves,
            'periodes' => $periodes,
        ]);
    }
}
