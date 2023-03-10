<?php

namespace App\Http\Controllers\Eleve;

use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
use App\Models\Classe_eleves;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{
    public function index()
    {
        $lesClasses = Classe_eleves::with('classe')
            ->where('user_id', Auth::user()->id)->get();
        //return $lesClasses;
        $eleve = User::with('personne', 'classeParAnnee', 'scolarite')-> where('role', 'eleve')->findOrFail( Auth::user()->id);
        return view('eleve.paiement.index', [
            'eleve' => $eleve,
            'lesClasses' => $lesClasses,
        ]);
    }
}
