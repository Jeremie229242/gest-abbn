<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClotureController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaintenancesController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\PlanificationController;
use App\Http\Controllers\PrestationController;
use App\Http\Controllers\SubscriptionController;
use App\Models\Client;
use App\Models\Prestation;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');






Route::group([
    "prefix" => "Admin",
    'as' => 'Admin.'
], function(){
    Route::resource('roles', RoleController::class);

    Route::resource('utilisateurs', UserController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('personnels', PersonnelController::class);

    Route::resource('e-mails', EmailController::class);
    Route::resource('subscriptions', SubscriptionController::class);
    Route::resource('planifications', PlanificationController::class);
    Route::resource('clotures', ClotureController::class);
    Route::get('subscriptions/{subscription}/download', [SubscriptionController::class, 'download'])->name('subscriptions.download');
    Route::patch('/subscriptions/{subscription}/toggle-position', [SubscriptionController::class, 'togglePosition'])
    ->name('subscriptions.toggle-position');
    Route::resource('prestations',   PrestationController::class);

    Route::post('/subscriptions/{subscription}/resilier', [SubscriptionController::class, 'resilier'])
    ->name('subscriptions.resilier');

    Route::post('/prestations/{prestation}/observation', [PrestationController::class, 'observe'])
    ->name('prestations.observation');

    Route::patch('/prestations/{prestation}/toggle-position', [PrestationController::class, 'togglePosition'])
    ->name('prestations.toggle-position');
    Route::get('prestations/{prestation}/download', [PrestationController::class, 'download'])->name('prestations.download');


    Route::get('/rapport/{id}', [HomeController::class, 'show'])->name('sites.rapport');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
