<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuth;
use App\Http\Controllers\PoneyController;

Route::get('/', function () {
    if (session()->has('user')) {
        return redirect('accueil');
    }
    return redirect('login');
});

Route::get('login', array('as'=>'login', function() {
    if (session()->has('user')) {
        return redirect('accueil');
    }
    return view('login');
}));

Route::post('login', [UserAuth::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('accueil', function () {
        return view('rendezvous');
    });

    Route::get('/poneys', [PoneyController::class, 'index'])->name('poneys.index');
    Route::post('add-pony', [PoneyController::class, 'add'])->name('poneys.add');
    Route::get('/poneys/{id}/edit', [PoneyController::class, 'edit'])->name('poneys.edit');
    Route::put('/poneys/{id}', [PoneyController::class, 'update'])->name('poneys.update');
    Route::delete('/poneys/{id}', [PoneyController::class, 'destroy'])->name('poneys.destroy');

    Route::get('historique', function () {
        return view('historique');
    });
    Route::get('deconnexion', [UserAuth::class, 'logout'])->name('deconnexion');
});