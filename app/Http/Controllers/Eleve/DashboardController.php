<?php

namespace App\Http\Controllers\Eleve;

use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Classe_eleves;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller {
    public function __construct() {
      $this->middleware('auth');
    }
    public function index() {

      $annee_scolaire = AnneeScolaire::where('active', true)->first();
      $classes = Classe_eleves::with('classe') 
                ->where('annee_scolaire_id', $annee_scolaire->id)
                ->where('user_id', Auth::user()->id)->first();
      
      $lesClasses = Classe_eleves::with('classe')
                    ->where('user_id', Auth::user()->id)->get();

      $classe = Classe::find($classes->classe_id);
      //return $lesClasses;
      return view('eleve.dashboard', [
        'classes' => $classes,
        'classe' => $classe,
        'lesClasses' => $lesClasses,
      ]);
    }
}
