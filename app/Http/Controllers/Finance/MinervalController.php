<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\AnneeScolaire;
use App\Models\Classe;
use App\Models\Scolarite;
use Illuminate\Http\Request;

class MinervalController extends Controller
{
    public function index()
    {
        $annee = AnneeScolaire::where('active', true)->first();
        $scolarites = Scolarite::with('classe')->where('annee_scolaire_id', $annee->id)->get();
        $classes = Classe::with('scolariteParAnnee')-> get();

        //return $classes;
        return view('finance.scolarite.index', [
            'scolarites' => $scolarites,
            'classes' => $classes,
        ]);
    }

    public function create()
    {
        return view('finance.minerval.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'montant' => 'required',
        ]);
        $annee = AnneeScolaire::where('active', true)->first();
        Scolarite::create([
            'montant' => $request->montant,
            'description' => $request->description,
            'classe_id' => $request->classe,
            'annee_scolaire_id' => $annee->id,
        ]);

        return redirect()->route('minerval.index')->with('success', 'Minerval Créé');
    }

    public function edit($id)
    {
        $minerval = Scolarite::find($id);
        return view('finance.minerval.edit', [
            'minerval' => $minerval,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'montant' => 'required',
        ]);
        $minerval = Scolarite::find($id);
        $minerval->update([
            'montant' => $request->montant,
            'description' => $request->description,
        ]);

        return redirect()->route('minerval.index')->with('success', 'Minerval Modifié');
    }

    public function destroy($id)
    {
        $minerval = Scolarite::find($id);
        $minerval->delete();
        return redirect()->route('minerval.index')->with('success', 'Minerval Supprimé');
    }
}
