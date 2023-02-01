<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classe;
use App\Models\Ecole;
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
        return view('admin.classe.create',[
            'ecole' => $ecole,
        ]);
    }

    public function store (Request $request){
        $request->validate([
            'nom' => 'required',
            'slug' => 'required',
            'niveau' => 'required',
            'description' => 'nullable',
        ]);

        $ecole = Ecole::firstOrFail();
        $classe = Classe::create(
            [
                'nom' => $request->get('nom'),
                'slug' => $request->get('slug'),
                'niveau' => $request->get('niveau'),
                'description' => $request->get('description'),
                'ecole_id' => $ecole->id,
            ]
        );

        return redirect()->route('classes.create')->with('success', 'Classe créée. Ajoutez une autre');
    }

    public function show ($classe){
        //$classe->load();
        $classe = Classe::findOrFail($classe);
        return view('admin.classe.show',
            [
                'classe' => $classe,
            ]
        );
    }
}
