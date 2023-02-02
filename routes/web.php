<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EcoleController;
use App\Http\Controllers\Eleve\DashboardController as EleveDashboardController;
use App\Http\Controllers\Prof\DashboardController as ProfDashboardController;
use App\Http\Controllers\Admin\PersonnelController as PersonnelAdminController;
use App\Http\Controllers\Admin\ClasseController as ClasseAdminController;
use App\Http\Controllers\Admin\AnneeScolaireController as AnneeScolaireAdminController;
use App\Http\Controllers\Admin\CoursController as CoursAdminController;
use App\Http\Controllers\PersonneController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::get('/admin_dashboard', [AdminDashboardController::class, 'index']);
    Route::resource('admin/ecole', EcoleController::class);
    Route::resource('personnel', PersonnelAdminController::class);
    Route::resource('classes', ClasseAdminController::class);
    Route::resource('annee_scolaire', AnneeScolaireAdminController::class);
    Route::resource('cours', CoursAdminController::class);
    Route::post('cours/{cours}/add_prof', [CoursAdminController::class, 'add_prof'])->name('cours.add_prof');
});

Route::group(['middleware' => ['auth', 'role:eleve']], function () {
    Route::get('/eleve_dashboard', [EleveDashboardController::class, 'index']);
});

Route::group(['middleware' => ['auth', 'role:prof']], function () {
    Route::get('/prof_dashboard', [ProfDashboardController::class, 'index']);
});

Route::group(['middleware' => ['auth']], function () {
    //Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('personne', PersonneController::class);
});