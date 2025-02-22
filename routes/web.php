<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\PoneyController;
use App\Http\Controllers\RendezVousController;
use Illuminate\Support\Facades\Auth;

Route::get('/reset-poney-hours', [JobController::class, 'resetPoneyHours']);

Route::get('/', function () {
    return Auth::check() ? redirect('/rendezvous') : redirect('/login');
});

Route::get('/login', function () {
    return Auth::check() ? redirect('/rendezvous') : view('login');
})->name('login');

Route::post('login', [UserAuth::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/poneys', [PoneyController::class, 'index'])->name('poneys.index');
    Route::post('add-pony', [PoneyController::class, 'add'])->name('poneys.add');
    Route::get('/poneys/{id}/edit', [PoneyController::class, 'edit'])->name('poneys.edit');
    Route::put('/poneys/{id}', [PoneyController::class, 'update'])->name('poneys.update');
    Route::delete('/poneys/{id}', [PoneyController::class, 'destroy'])->name('poneys.destroy');
    Route::get('/rendezvous', [RendezVousController::class, 'index'])->name('rendezvous.index');
    Route::post('/rendezvous', [RendezVousController::class, 'store'])->name('rendezvous.store'); 
    Route::post('/rendezvous/cancel/{id}', [RendezVousController::class, 'cancel'])->name('rendezvous.cancel');

    Route::get('/historique', function () {
        return view('historique');
    })->name('historique');
    Route::get('deconnexion', [UserAuth::class, 'logout'])->name('deconnexion');
});