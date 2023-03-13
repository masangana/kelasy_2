<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParentController extends Controller
{
    public function index()
    {
        return view('admin.parent.index');
    }

    public function create()
    {
        return view('admin.parent.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }
}
