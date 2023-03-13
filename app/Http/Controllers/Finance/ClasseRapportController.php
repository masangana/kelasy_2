<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Motif;
use Illuminate\Http\Request;

class ClasseRapportController extends Controller
{
    public function index()
    {
        $classes = Classe::all();
        return view('finance.rapport.classe', [
            'classes' => $classes,
        ]);
    }

    public function create()
    {
        return view('finance.rapport.classe.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|unique:classes',
            'description' => 'required',
        ]);

        Classe::create([
            'nom' => $request->nom,
            'description' => $request->description,
        ]);

        return redirect()->route('classe.index')->with('success', 'Classe Créée');
    }

    public function show($classe)
    {   
        $classe = Classe::with(['eleves' => function($querry){
            $querry->with('personne', 'fraisScolarite', 'AutresFrais');
        }])-> findOrFail($classe);

        $motifs = Motif::where('nom', '!=', 'scolarité')->get() ;
        
        return view('finance.rapport.show', [
            'classe' => $classe,
            'motifs' => $motifs,
        ]);
    }
}
