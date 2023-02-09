<?php

namespace App\Http\Controllers\Prof;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Cours;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    public function __construct() {
      $this->middleware('auth');
    }
    public function index() {
      $classes = Classe::where('professeur_id', Auth::user()->id)->get();
      $personne = User::with(['hasCours' => function ($querry)  {
            $querry->with('classe');
        }]
      )->findOrFail(Auth::user()->id);
      //return $personne->hasCours;
      return view('prof.dashboard', 
        [
          'classes' => $classes,
          'personne' => $personne,
        ]);
    }
}
