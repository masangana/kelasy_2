<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ecole;
use Illuminate\Http\Request;

class DashboardController extends Controller {
    public function __construct() {
      $this->middleware('auth');
    }
    public function index() {
      $ecole = Ecole::firstOrFail();

      return view('admin.dashboard', [
        'ecole' => $ecole,
      ]);
    }
}
