<?php

namespace App\Http\Controllers\Eleve;

use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
use App\Models\Classe_eleves;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }
    public function index() {
      return view('eleve.profile');
    }

    public function show($id) {
        
        $user = User::with('personne')-> find($id);
        $lesClasses = Classe_eleves::with('classe')
            ->where('user_id', Auth::user()->id)->get();
        $anneeScolaire = AnneeScolaire::where('active', true)->first();
        $classe_active = Classe_eleves::with('classe')
                        ->where([['user_id','=',$user->id], ['annee_scolaire_id','=',$anneeScolaire->id]]) ->first();
        //return $classe_active;
        return view('eleve.profile.show', [
            'user' => $user,
            'lesClasses' => $lesClasses,
            'classe_active' => $classe_active,
            'annee' => $anneeScolaire,
        ]);
    }
}
