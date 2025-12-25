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
use App\Http\Controllers\SubscriptionInvoiceController;
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






Route::middleware(['auth'])->group(function () {
    Route::prefix('Admin')->as('Admin.')->group(function () {
    Route::resource('roles', RoleController::class);

    Route::resource('utilisateurs', UserController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('personnels', PersonnelController::class);

    Route::resource('e-mails', EmailController::class);
    Route::resource('subscriptions', SubscriptionController::class);
    Route::resource('invoices', SubscriptionInvoiceController::class);
    Route::resource('planifications', PlanificationController::class);
    Route::resource('clotures', ClotureController::class);
    Route::get('invoices/{subscriptionInvoice}/download', [SubscriptionInvoiceController::class, 'download'])->name('invoices.download');
    Route::patch('/subscriptions/{subscription}/toggle-position', [SubscriptionController::class, 'togglePosition'])
    ->name('subscriptions.toggle-position');
    Route::resource('prestations',   PrestationController::class);

    Route::post('/subscriptions/{subscription}/resilier', [SubscriptionController::class, 'resilier'])
    ->name('subscriptions.resilier');

    Route::post('/prestations/{prestation}/observation', [PrestationController::class, 'observe'])
    ->name('prestations.observation');
    Route::post('/prestations/{prestation}/cloture', [PrestationController::class, 'cloture'])
    ->name('prestations.cloture');

    Route::patch('/planifications/{prestation}/toggle-position', [PlanificationController::class, 'togglePosition'])
    ->name('planifications.toggle-position');
    Route::patch('/prestations/{prestation}/toggle-position', [PrestationController::class, 'togglePosition'])
    ->name('prestations.toggle-position');
    Route::get('prestations/{prestation}/download', [PrestationController::class, 'download'])->name('prestations.download');


    Route::get('/rapport/{id}', [HomeController::class, 'show'])->name('sites.rapport');

});
});



Route::get('/prestations/clients', [PrestationController::class, 'prestationsClotureesParClient'])->name('Admin.prestations.clients');
Route::get('/prestations/{client}',
    [PrestationController::class, 'detailsCloturees']
)->name('Admin.prestations.details');
Route::get('/prestations/moi/encours', [PrestationController::class, 'encours'])->name('Admin.prestations.moi.encours');
Route::get('/prestations/moi/plans', [PlanificationController::class, 'plan'])->name('Admin.prestations.moi.plans');
Route::get('/prestations/moi/clotures', [ClotureController::class, 'clotureees'])->name('Admin.prestations.moi.clotures');


Route::patch(
    '/invoices/{invoice}/status',
    [SubscriptionInvoiceController::class, 'updateStatus']
)->name('Admin.invoices.updateStatus');



Route::get('/subscriptions/{subscription}/renew',
    [SubscriptionController::class, 'renewForm']
)->name('Admin.subscriptions.renew');



Route::post('/subscriptions/{subscription}/renew',
    [SubscriptionController::class, 'renewStore']
)->name('Admin.subscriptions.renew.store');

Route::get('/subscriptions/moi/actifs', [SubscriptionController::class, 'actif'])->name('Admin.subscriptions.moi.actifs');
Route::get('/subscriptions/moi/expires', [SubscriptionController::class, 'expire'])->name('Admin.subscriptions.moi.expires');

Route::get('/invoices/client', [SubscriptionInvoiceController::class, 'client'])->name('Admin.invoices.client');

// Page édition toutes les observations d’un diagnostic
Route::get('/prestations/{prestation}/observations/edit', [PrestationController::class, 'editObservations'])
    ->name('Admin.prestations.observations.edit');

// Mise à jour des observations
Route::put('/prestations/{prestation}/observations', [PrestationController::class, 'updateObservations'])
    ->name('Admin.prestations.observations.update');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
