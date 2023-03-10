<?php

namespace App\Http\Controllers\Eleve;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{
    public function index()
    {
        $eleve = User::with('personne', 'classeParAnnee', 'scolarite')-> where('role', 'eleve')->findOrFail( Auth::user()->id);
        return view('eleve.paiement.index', [
            'eleve' => $eleve,
        ]);
    }
}
