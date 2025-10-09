<?php

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
use App\Http\Controllers\SubscriptionController;

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
    Route::resource('sites', SiteController::class);
    Route::resource('personnels', PersonnelController::class);
    Route::resource('materiels', MaterielController::class);
    Route::resource('maintenances', MaintenancesController::class);
    Route::resource('e-mails', EmailController::class);
    Route::resource('subscriptions', SubscriptionController::class);
    Route::get('subscriptions/{subscription}/download', [SubscriptionController::class, 'download'])->name('subscriptions.download');

    Route::put('maintenances/{maintenance}/approve', [MaintenancesController::class, 'approve'])->name('maintenances.approve');
    Route::get('/rapport/{id}', [HomeController::class, 'show'])->name('sites.rapport');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
