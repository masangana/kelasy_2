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
use App\Http\Controllers\Admin\EleveController as EleveAdminController;
use App\Http\Controllers\Prof\ClasseController as ClasseProfController;
use App\Http\Controllers\Prof\CoursController as CoursProfController;
use App\Http\Controllers\Prof\CoteController as CoteProfController;
use App\Http\Controllers\Prof\EleveController as EleveProfController;
use App\Http\Controllers\Eleve\ClasseController as ClasseEleveController;
use App\Http\Controllers\Eleve\ProfileController as EleveProfileController;
use App\Http\Controllers\PersonneController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Finance\DashboardController as FinanceDashboardController;
use App\Http\Controllers\Finance\MinervalController;//ce controller permet de creer le minerval
use App\Http\Controllers\Finance\PaiementController as FinancePaiementController;
use App\Http\Controllers\Finance\MotifController as FinanceMotifController;
use App\Http\Controllers\Parent\DashboardController as ParentDashboardController;


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
    Route::resource('eleves', EleveAdminController::class);
    Route::post('cours/{cours}/add_prof', [CoursAdminController::class, 'add_prof'])->name('cours.add_prof');
});

Route::group(['middleware' => ['auth', 'role:eleve']], function () {
    Route::get('/eleve_dashboard', [EleveDashboardController::class, 'index'])->name('eleve.home');
    Route::resource('classe', ClasseEleveController::class);
    Route::resource('profile', EleveProfileController::class);
});

Route::group(['middleware' => ['auth', 'role:prof']], function () {
    Route::get('/prof_dashboard', [ProfDashboardController::class, 'index'])->name('prof.home') ;
    Route::post('cours/archivePeriode', [CoursProfController::class, 'archivePeriode'])->name('cours.archive_periode');
    Route::resource('classe_prof', ClasseProfController::class);
    Route::resource('cours_prof', CoursProfController::class);
    Route::resource('cote_prof', CoteProfController::class);
    Route::resource('eleve', EleveProfController::class);
});

Route::group(['middleware' => ['auth', 'role:finance']], function () {
    Route::get('/finance_dashboard', [FinanceDashboardController::class, 'index'])->name('finance.home');
    Route::resource('minerval', MinervalController::class);
    Route::resource('paiement', FinancePaiementController::class);
    Route::resource('motif', FinanceMotifController::class);
});

Route::group(['middleware' => ['auth']], function () {
    //Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('personne', PersonneController::class);
});