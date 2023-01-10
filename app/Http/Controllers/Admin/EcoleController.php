<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
      return view('admin.ecole.store');
    }
    public function show($id) {
      return view('admin.ecole.show');
    }
    public function edit($id) {
      return view('admin.ecole.edit');
    }
    public function update(Request $request, $id) {
      return view('admin.ecole.update');
    }
    public function destroy($id) {
      return view('admin.ecole.destroy');
    }
}
