<?php

namespace App\Http\Controllers\Prof;

use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Cours;
use App\Models\Epreuve;
use App\Models\GroupeCote;
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

        $groupe_cote = GroupeCote::where('cours_id', $id)->where('annee_scolaire_id', $annee_scolaire->id)->get();

        $epreuves = Epreuve::all();
        $periodes = Periode::all();

        foreach ($groupe_cote as $index =>  $value) {
            foreach($epreuves as $epreuve){
                if($value->epreuve_id == $epreuve->id){
                    $periodeTable[$index] = $value->periode_id;

                }
            }
        }


        /* Sort the array and remove doubled items */
        asort($periodeTable);
        $periodeTable = array_unique($periodeTable); 
        /*Compte manuel des activités dans une periode*/

        $compte1 = GroupeCote::where('periode_id', 1)
            ->where('cours_id', $id)
            ->where('annee_scolaire_id', $annee_scolaire->id)->count();

        $compte2 = GroupeCote::where('periode_id', 2)
            ->where('cours_id', $id)
            ->where('annee_scolaire_id', $annee_scolaire->id)->count();

        $compte3 = GroupeCote::where('periode_id', 3)
            ->where('cours_id', $id)
            ->where('annee_scolaire_id', $annee_scolaire->id)->count();

        $compte4 = GroupeCote::where('periode_id', 4)
            ->where('cours_id', $id)
            ->where('annee_scolaire_id', $annee_scolaire->id)->count();

        $compte5 = GroupeCote::where('periode_id', 5)
            ->where('cours_id', $id)
            ->where('annee_scolaire_id', $annee_scolaire->id)->count();

        $compte6 = GroupeCote::where('periode_id', 6)
            ->where('cours_id', $id)
            ->where('annee_scolaire_id', $annee_scolaire->id)->count();
        
        /*Fin compte manuel des activités dans une periode*/

        /***  This Part MUST BE REVIEWED AND OPTIMISED  */

        return view('prof.cours.show', [
            'classes' => $classes,
            'personne' => $personne,
            'cours' => $cours,
            'epreuves' => $epreuves,
            'periodes' => $periodes,
            'annee_scolaire' => $annee_scolaire,
            'groupe_cote' => $groupe_cote,
            'periodeTable' => $periodeTable,
            'compte1' => $compte1,
            'compte2' => $compte2,
            'compte3' => $compte3,
            'compte4' => $compte4,
            'compte5' => $compte5,
            'compte6' => $compte6,
        ]);
    }
}
