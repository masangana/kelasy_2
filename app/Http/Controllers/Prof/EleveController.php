<?php

namespace App\Http\Controllers\Prof;

use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Classe_eleves;
use App\Models\Epreuve;
use App\Models\GroupeCote;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EleveController extends Controller
{
    public function show($id){

        /*script pour menu*/
        $classes = Classe::with(['eleves' => function ($q){
            $q->with('personne');
        }, 'cours' => function ($qe){
            $qe->with('archivedPeriode');
        }])-> where('professeur_id', Auth::user()->id)->get();

        //return $classes;
        $personne = User::with(['hasCours' => function ($querry)  {
              $querry->with('classe');
          }]
        )->findOrFail(Auth::user()->id);
        /*fin script pour menu*/

        $eleve = User::with(['personne', 'hasCote' => function ($q){
            $q->with('epreuve', 'periode');
        }, 'isPupil'])->findOrFail($id);
        //return $eleve;
        $anneeScolaire = AnneeScolaire::where('active', true)->first();
        $classe_active = Classe_eleves::where([['user_id','=',$eleve->id], ['annee_scolaire_id','=',$anneeScolaire->id]]) ->first();

        /* Cette section gere les données qui permettent d'afficher l'entete du tableau */
        //return $eleve;
        $groupe_cote = GroupeCote::where('cours_id', $id)->where('annee_scolaire_id', $anneeScolaire->id)->get();

        $epreuves = Epreuve::all();
        $periodes = Periode::all();
        $periodeTable = [];
        foreach ($groupe_cote as $index =>  $value) {
            foreach($epreuves as $epreuve){
                if($value->epreuve_id == $epreuve->id){
                    $periodeTable[$index] = $value->periode_id;

                }
            }
        }


        /* Sort the array and remove doubled items */
        if( sizeof($periodeTable) > 0 ){
            asort($periodeTable);
            $periodeTable = array_unique($periodeTable);
        }

        /*Compte manuel des activités dans une periode*/

        $compte1 = GroupeCote::where('periode_id', 1)
            ->where('cours_id', $id)
            ->where('annee_scolaire_id', $anneeScolaire->id)->count();

        $compte2 = GroupeCote::where('periode_id', 2)
            ->where('cours_id', $id)
            ->where('annee_scolaire_id', $anneeScolaire->id)->count();

        $compte3 = GroupeCote::where('periode_id', 3)
            ->where('cours_id', $id)
            ->where('annee_scolaire_id', $anneeScolaire->id)->count();

        $compte4 = GroupeCote::where('periode_id', 4)
            ->where('cours_id', $id)
            ->where('annee_scolaire_id', $anneeScolaire->id)->count();

        $compte5 = GroupeCote::where('periode_id', 5)
            ->where('cours_id', $id)
            ->where('annee_scolaire_id', $anneeScolaire->id)->count();

        $compte6 = GroupeCote::where('periode_id', 6)
            ->where('cours_id', $id)
            ->where('annee_scolaire_id', $anneeScolaire->id)->count();
        
        /*Fin compte manuel des activités dans une periode*/

        /***  This Part MUST BE REVIEWED AND OPTIMISED  */

        return view('prof.eleve.show',[
            'classes' => $classes,
            'personne' => $personne,
            'eleve' => $eleve,
            'anneeScolaire' => $anneeScolaire,
            'classe_active' => $classe_active,
            'groupe_cote' => $groupe_cote,
            'epreuves' => $epreuves,
            'periodes' => $periodes,
            'periodeTable' => $periodeTable,
            'compte1' => $compte1,
            'compte2' => $compte2,
            'compte3' => $compte3,
            'compte4' => $compte4,
            'compte5' => $compte5,
            'compte6' => $compte6,
        ]);
    }

    /**
     */
    public function __construct() {
    }
}
