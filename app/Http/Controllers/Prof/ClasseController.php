<?php

namespace App\Http\Controllers\Prof;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Cours;
use App\Models\Cours_profs;
use App\Models\Periode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClasseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('prof.classe.index');
    }

    public function show($id)
    {
        /*script pour menu*/
        $classes = Classe::with(['eleves' => function ($q){
            $q->with('personne');
        }])-> where('professeur_id', Auth::user()->id)->get();
        $personne = User::with(['hasCours' => function ($querry)  {
                $querry->with('classe');
            }]
        )->findOrFail(Auth::user()->id);
        /*fin script pour menu*/

        $classe = Classe::with(['eleves' => function ($q){
            $q->with('personne', 'hasCoteByCursus');
        }])->findOrFail($id);

        //return $classe;

        /**Load Teachers for this class */

        $cours = Cours::where('classe_id', $id)->with(
            [ 'archivedPeriode', 'professeurs' => function ($q){
                    $q->with('personne');
                }
            ]
        ) ->get();

        $periodes = Periode::all();
  
        return view('prof.classe.show',
            [
                'classes' => $classes,
                'personne' => $personne,
                'classe' => $classe,
                'cours' => $cours,
                'periodes' => $periodes,
            ]
        );
    }
}
