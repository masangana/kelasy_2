<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Cours;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $classes = Classe::with(['eleves' => function ($q){
            $q->with('personne');
        }, 'cours' => function ($qe){
            $qe->with('archivedPeriode');
        }])-> where('professeur_id', Auth::user()->id)->get();

        $personne = User::with(['hasCours' => function ($querry)  {
              $querry->with('classe');
          }]
        )->findOrFail(Auth::user()->id);
        return view('home', [
            'classes' => $classes,
            'personne' => $personne,
        ]);
    }
}
