<?php

namespace App\Http\Controllers;

use App\Models\AnneeScolaire;
use App\Models\Ecole;
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
            //return $user;
            Personne::create([
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

            $annee = AnneeScolaire::where('active', true)->firstOrFail();
            if ($user_role->nom == 'eleve') {
                $user
                    ->isPupil()
                    ->attach($request->get('classe'), ['annee_scolaire_id' => $annee->id]);
            }
        });



        if ($request->get('role') == '2') {
            return redirect("/eleves/create")->with('success','Eleve enregistré!');
        } else {
           return redirect("/personnel/create")->with('success','Personnel enregistré!');
        }
        
       
    }

    public function show (Personne $personne){

        $ecole = Ecole::firstOrFail();
        $personne->load(['user'=> function ($request){
            $request->with('isPupil');
        }]);

        $annee_table = [];

        if (sizeof($personne->user->isPupil) != 0) {
            foreach ($personne->user->isPupil as $key => $value) {

                $annee_table[] = AnneeScolaire::find($value->pivot->annee_scolaire_id);
            }
        }

        //return $anne_table;

        //return $personne;
        return view('personne.show', [
            'personne' => $personne,
            'ecole' => $ecole,
            'annees' => $annee_table,
        ]);
    }
}
