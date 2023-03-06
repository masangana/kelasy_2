<?php

namespace App\Http\Controllers\Eleve;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Classe_eleves;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClasseController extends Controller
{
    public function show($id) {
        $eleve = User::with('hasCoteByCursus')->findOrFail(Auth::user()->id);
        $classe = Classe::with(['cours' => function ($q){
            $q->with(['archivedPeriode', 'professeurs'=> function ($q){
                $q->with('personne');
            }]);
        }])->findOrFail($id);

        $lesClasses = Classe_eleves::with('classe')
                    ->where('user_id', Auth::user()->id)->get();
        return $lesClasses;
        return view('eleve.classe.show', [
            'classe' => $classe,
            'eleve' => $eleve,
            'lesClasses' => $lesClasses,
        ]);
    }
}
