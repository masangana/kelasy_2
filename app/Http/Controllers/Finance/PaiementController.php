<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
use App\Models\Motif;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PaiementController extends Controller
{
    public function index()
    {
        $motifs = Motif::all();
        $eleves = User::with('personne', 'classeParAnnee')-> where('role', 'eleve')->get();
        $annee = AnneeScolaire::where('active', true)->first();
        $paiements = Paiement::with('eleve', 'personnel', 'motif', 'annee_scolaire')
            ->where('annee_scolaire_id', $annee->id)->orderBy('created_at', 'DESC')
            ->get();
        return view('finance.paiement.index', [
            'motifs' => $motifs,
            'eleves' => $eleves,
            'paiements' => $paiements,
        ]);
    }

    public function create()
    {
        return view('finance.paiement.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'montant' => 'required',
            'eleve' => 'required',
            'motif' => 'required',
        ]);

        $annee = AnneeScolaire::where('active', true)->first();

        do
        {
            $numero = Str::random(10) ;
            $paieNum = Paiement::where('numero', $numero)->first();
        }
        while(!empty($paieNum));

        Paiement::create(
            [
                'montant' => $request->montant,
                'motif_id' => $request->motif,
                'eleve_id' => $request->eleve,
                'personnel_id' => auth()->user()->id,
                'annee_scolaire_id' => $annee->id,
                'description' => $request->description,
                'numero' => $numero,
            ]
        );

        return redirect()->route('paiement.index')->with('success', 'Paiement effectué avec succès');
    }

    public function show($id)
    {
        $eleve = User::with('personne', 'classeParAnnee', 'scolarite')-> where('role', 'eleve')->findOrFail($id);
        return view('finance.paiement.show', [
            'eleve' => $eleve,
        ]);
    }
}
