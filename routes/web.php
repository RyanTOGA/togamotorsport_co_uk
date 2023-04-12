<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StewardController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'driver'], function () {
    Route::get('/', [DriverController::class, 'index']);
});

Route::group(['prefix' => 'steward', 'as' => 'steward.'], function () {
    Route::get('all-incidents', [StewardController::class, 'incidents'])->name('incidents');
    Route::get('raise-a-ticket', [StewardController::class, 'index'])->name('form');
    Route::post('raise-a-ticket', [StewardController::class, 'store'])->name('form.store');
    Route::get('incident-report/{id}', [StewardController::class, 'report'])->name('incident');
    Route::get('incident-report/{id}/give-penalty', [StewardController::class, 'penalty'])->name('incident.penalty');
    Route::post('incident-report/{id}/give-penalty/save', [StewardController::class, 'apply'])->name('incident.penalty.store');
    Route::get('incident-report/{id}/delete', [StewardController::class, 'delete'])->name('incident.delete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
