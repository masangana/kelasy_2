<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Eleve;
use App\Models\Personne;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EleveController extends Controller
{
    public function index (){
        return view('admin.eleve.index');
    }

    public function create (){
        return view('admin.eleve.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'postnom' => 'required',
            'prenom' => 'required',
            'adresse' => 'required',
            'date_naissance' => 'required',
            'lieu_naissance' => 'required',
            'sexe' => 'required',
            'photo' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);

        //return $request->all();

        DB::transaction(function () use ($request) {
            $file = $request->photo;
            if ($request->hasFile('photo')) {
                $imageName = time() . rand(0, 99) . '.' . $file->extension();
                $file->move(public_path('images/personnes'), $imageName);
            }
            $password = Str::random(10);
            $user_role = Role::findOrfail($request->get('role'));
            $user = User::create([
                'name' => $request->get('nom'),
                'email' => $request->get('email'),
                'password' => Hash::make($password),
                'role' => $user_role->nom,
                'role_id' => $request->get('role'),
                'ecole_id' => Auth::user()->ecole_id,
            ]);
            $personne = Personne::create([
                'nom' => $request->get('nom'),
                'postnom' => $request->get('postnom'),
                'prenom' => $request->get('prenom'),
                'adresse' => $request->get('adresse'),
                'date_naissance' => $request->get('date_naissance'),
                'lieu_naissance' => $request->get('lieu_naissance'),
                'sexe' => $request->get('sexe'),
                'photo' => $imageName,
                'user_id' => $user->id,
                'ecole_id' => Auth::user()->ecole_id,
            ]);
            Eleve::create([
                'personne_id' => $personne->id,
                'ecole_id' => Auth::user()->ecole_id,
            ]);
        });

        return redirect()->route('eleves.create')->with('success', 'Eleve créé avec success');
    }
}
