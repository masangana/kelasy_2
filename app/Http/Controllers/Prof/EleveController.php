<?php

namespace App\Http\Controllers\Prof;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EleveController extends Controller
{
    public function show($id){

        /*script pour menu*/
        $classes = Classe::with(['eleves' => function ($q){
            $q->with('personne');
        }, 'cours'])-> where('professeur_id', Auth::user()->id)->get();
        $personne = User::with(['hasCours' => function ($querry)  {
              $querry->with('classe');
          }]
        )->findOrFail(Auth::user()->id);
        /*fin script pour menu*/

        $eleve = User::with('personne', 'hasCote')->findOrFail($id);


        //return $classes;
        return view('prof.eleve.show',[
            'classes' => $classes,
            'personne' => $personne,
            'eleve' => $eleve,
        ]);
    }
}
