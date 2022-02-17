<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LeaseRequestController;
use App\Http\Controllers\PaymentOptionController;

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

Route::get('/', [Controller::class, 'index'])->name('home');

Route::resource('cars', CarController::class);
Route::delete('cars/image/{image}', [CarController::class, 'destroyImage']);

Route::get('client/historic/{client}', [ClientController::class, 'listeLease']);
Route::resource('clients', ClientController::class);
Route::delete('clients/document/{document}', [ClientController::class, 'destroyImage']);

Route::get('lease-request/{status?}', [LeaseRequestController::class, 'index'])->name('lease-request.index');
Route::get('lease-request/create/{status}/{car}', [LeaseRequestController::class, 'create'])->name('lease-request.create');
Route::post('lease-request/create/{status}', [LeaseRequestController::class, 'store'])->name('lease-request.store');
Route::patch('lease-request/{lease}', [LeaseRequestController::class, 'updateStatus'])->name('lease-request.update-status');
//Route::resource('lease-request', LeaseRequestController::class);

Route::resource('payment-options', PaymentOptionController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
