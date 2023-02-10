<?php

namespace App\Http\Controllers\Prof;

use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Cours;
use App\Models\Epreuve;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoursController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }
    public function index() {
      return view('prof.cours');
    }

    public function show($id) {
        /*script pour menu*/
        $classes = Classe::with(['eleves' => function ($q){
            $q->with('personne');
        }])-> where('professeur_id', Auth::user()->id)->get();
        $personne = User::with(['hasCours' => function ($querry)  {
              $querry->with('classe');
          }]
        )->findOrFail(Auth::user()->id);
        /*fin script pour menu*/

        $annee_scolaire = AnneeScolaire::where('active', true)->first();
        $cours = Cours::with(['classe' => function ($querry){
            $querry->with(['eleves' => function ($q){
                $q->with('personne', 'hasCote');
            }]);
        }])->findOrFail($id);

        //return $cours;

        $epreuves = Epreuve::all();
        $periodes = Periode::all();

        return view('prof.cours.show', [
            'classes' => $classes,
            'personne' => $personne,
            'cours' => $cours,
            'epreuves' => $epreuves,
            'periodes' => $periodes,
            'annee_scolaire' => $annee_scolaire,
        ]);
    }
}
