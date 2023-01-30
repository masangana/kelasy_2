<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use Illuminate\Http\Request;

class PersonneController extends Controller
{
    public function index (){
        return view('personne.index');
    }

    public function create (){
        return view('personne.create');
    }

    public function store (Request $request){
        $request->validate([
            'nom' => 'required',
            'postnom' => 'required',
            'prenom' => 'required',
            'adresse' => 'required',
            'date_naissance' => 'required',
            'lieu_naissance' => 'required',
            'sexe' => 'required',
            'photo' => 'required',
            'ecole_id' => 'required',
        ]);



        $personne = new Personne([
            'nom' => $request->get('nom'),
            'postnom' => $request->get('postnom'),
            'prenom' => $request->get('prenom'),
            'email' => $request->get('email'),
            'telephone' => $request->get('telephone'),
            'adresse' => $request->get('adresse'),
            'date_naissance' => $request->get('date_naissance'),
            'lieu_naissance' => $request->get('lieu_naissance'),
            'sexe' => $request->get('sexe'),
            'photo' => $request->get('photo'),
            'ecole_id' => $request->get('ecole_id'),
        ]);
        $personne->save();
        return redirect('/personnes')->with('success', 'Personne enregistrée!');
    }
}
