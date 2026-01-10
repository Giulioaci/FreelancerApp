<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\SimulatorController;
use App\Http\Controllers\QuoteController;

// Pagina di benvenuto (pubblica)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (email verificata OBBLIGATORIA)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Tutte le rotte protette (AUTH + VERIFIED)
Route::middleware(['auth', 'verified'])->group(function () {

    // Profilo utente
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Gestione clienti
    Route::resource('clients', ClientController::class);

    // Gestione appuntamenti
    Route::resource('appointments', AppointmentController::class);

    // Storico conversazioni
    Route::resource('conversations', ConversationController::class);

    // Simulatore di reddito
    Route::get('/simulator', [SimulatorController::class, 'form'])->name('simulator.form');
    Route::post('/simulator', [SimulatorController::class, 'calculate'])->name('simulator.calculate');

    // Preventivi
    Route::resource('quotes', QuoteController::class);
    Route::post('quotes/{quote}/items', [QuoteController::class, 'addItem'])->name('quotes.items.add');
    Route::delete('quotes/{quote}/items/{item}', [QuoteController::class, 'removeItem'])->name('quotes.items.remove');
    Route::get('quotes/{quote}/pdf', [QuoteController::class, 'downloadPdf'])->name('quotes.downloadPdf');
});

// Pagine pubbliche
Route::get('/chi-siamo', function () {
    return view('chi-siamo');
})->name('chi-siamo');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

// Autenticazione (login, register, verify-email ecc.)
require __DIR__.'/auth.php';
