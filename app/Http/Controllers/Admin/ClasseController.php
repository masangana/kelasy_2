<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Ecole;
use App\Models\User;
use Illuminate\Http\Request;

class ClasseController extends Controller
{
    public function index (){

        $classes = Classe::all();
        return view('admin.classe.index', 
            [
                'classes' => $classes,
            ]);
    }

    public function create (){
        $ecole = Ecole::firstOrFail();
        $profs = User::where('role', '=', 'prof')->get();
        //return $profs;
        return view('admin.classe.create',[
            'ecole' => $ecole,
            'profs' => $profs,
        ]);
    }

    public function store (Request $request){
        $request->validate([
            'nom' => 'required',
            'slug' => 'required',
            'niveau' => 'required',
            'prof' => 'required',
            'description' => 'nullable',
        ]);

        $ecole = Ecole::firstOrFail();
        $classe = Classe::create(
            [
                'nom' => $request->get('nom'),
                'slug' => $request->get('slug'),
                'niveau' => $request->get('niveau'),
                'description' => $request->get('description'),
                'professeur_id' => $request->get('prof'),
                'ecole_id' => $ecole->id,
            ]
        );

        return redirect()->route('classes.create')->with('success', 'Classe créée. Ajoutez une autre');
    }

    public function show ($classe){
        
        $classe = Classe::with('tuteur')-> findOrFail($classe);
        $prof = User::with('personne')->where('id', $classe->tuteur->id)->get();
        //return $classe;
        return view('admin.classe.show',
            [
                'classe' => $classe,
                'prof' => $prof,
            ]
        );
    }
}