<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ecole;
use Illuminate\Http\Request;

class EcoleController extends Controller
{
    public function __construct() {
      $this->middleware('auth');
    }
    public function index() {
      return view('admin.ecole.index');
    }
    public function create() {
      return view('admin.ecole.create');
    }
    public function store(Request $request) {
      

      $request->validate([
        'nom' => 'required',
        'adresse' => 'required',
        'phone' => 'required',
      ]);

      //return $request->all();

      $ecole = new Ecole();
      $ecole->nom = $request->nom;
      $ecole->slug = $request->slug;
      $ecole->adresse = $request->adresse;
      $ecole->telephone = $request->phone;
      $ecole->email = $request->email;
      $ecole->description = $request->description;
      $file = $request->logo;
      if ($request->hasFile('logo')) {
            $imageName = time().rand(0, 99).'.'.$file->extension();
            $file->move(public_path('images/logo'), $imageName);
            $ecole->logo = $imageName;
      }
      $ecole->save();
      return redirect()->route('ecole.index');
    }
    public function show($id) {
      $ecole = Ecole::firstOrFail();
      //return $ecole;
      return view('admin.ecole.show', [
        'ecole' => $ecole,
      ]);
    }
    public function edit($id) {
      return view('admin.ecole.edit');
    }
    public function update(Request $request, $id) {
      $ecole = Ecole::find($id);

      $request->validate([
        'nom' => 'required',
        'adresse' => 'required',
        'phone' => 'required',
      ]);

      $ecole->nom = $request->nom;
      $ecole->slug = $request->slug;
      $ecole->adresse = $request->adresse;
      $ecole->telephone = $request->phone;
      $ecole->logo = $request->logo;
      $ecole->email = $request->email;
      $ecole->description = $request->description;

      if ( $request->logo == null) {
        $ecole->logo = $request->logo;
      } else {
        $file = $request->logo;
        if ($request->hasFile('logo')) {
          $imageName = time().rand(0, 99).'.'.$file->extension();
          $file->move(public_path('images/logo'), $imageName);
          $ecole->logo = $imageName;
        }
      }

      return $ecole;
      

      //return $request->all();
      return view('admin.ecole.update');
    }
    public function destroy($id) {
      return view('admin.ecole.destroy');
    }
}
