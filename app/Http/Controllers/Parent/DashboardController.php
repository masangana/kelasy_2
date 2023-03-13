<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {   
        $parent = User::with('personne', 'aDesEnfants')
                ->find(Auth::user()->id);
        //return $parent->aDesEnfants;
        return view('parent.dashboard', [
            'parent' => $parent,
        ]);
    }
}
