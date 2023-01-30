<?php

namespace App\Http\Controllers;

use App\Models\Personne;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonneController extends Controller
{
    public function index (){
        return view('personne.index');
    }

    public function create (){
        return view('personne.create');
    }

    public function store (Request $request){
        //return $request->all();
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

        DB::transaction(function() use ($request)
        {
            $file = $request->photo;
            if ($request->hasFile('photo')) {
                $imageName = time().rand(0, 99).'.'.$file->extension();
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
                'email' => $request->get('email'),
                'telephone' => $request->get('telephone'),
                'adresse' => $request->get('adresse'),
                'date_naissance' => $request->get('date_naissance'),
                'lieu_naissance' => $request->get('lieu_naissance'),
                'sexe' => $request->get('sexe'),
                'photo' => $imageName,
                'user_id' => $user->id,
                'ecole_id' => Auth::user()->ecole_id,
            ]);
        });

        if (Role::findOrfail($request->get('role')) == 'eleve') {
            $roles = Role::findOrfail($request->get('role'));
        } else {
           $roles = Role::where('nom','=' ,'prof')->orWhere('nom','=', 'admin')->get();
        }
        
        return redirect("/personnel/create")->with('success','Personne enregistrée!');
    }
}
