<?php

namespace App\Http\Controllers\Finance;

use App\Http\Controllers\Controller;
use App\Models\Motif;
use Illuminate\Http\Request;

class MotifController extends Controller
{
    public function index()
    {
        $motifs = Motif::all();
        return view('finance.motif.index', [
            'motifs' => $motifs,
        ]);
    }

    public function create()
    {
        return view('finance.motif.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|unique:motifs',
            'description' => 'required',
        ]);

        Motif::create([
            'nom' => $request->nom,
            'description' => $request->description,
        ]);

        return redirect()->route('motif.index')->with('success', 'Motif Créé');
    }
}
