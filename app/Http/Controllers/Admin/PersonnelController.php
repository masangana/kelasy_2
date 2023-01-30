<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ecole;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    public function index (){
        return view('admin.personnel.index');
    }

    public function create (){
        $ecole = Ecole::firstOrFail();
        
        return view('admin.personnel.create', [
            'ecole' => $ecole,
        ]);
    }

}
