<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\SimulatorController;
use App\Http\Controllers\QuoteController;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Illuminate\Http\Request;

// --------------------
// Pagine pubbliche
// --------------------
Route::get('/', fn() => view('welcome'));

Route::get('/chi-siamo', fn() => view('chi-siamo'))->name('chi-siamo');
Route::get('/privacy', fn() => view('privacy'))->name('privacy');

// --------------------
// Dashboard protetta
// --------------------
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// --------------------
// Rotte protette (auth + verified)
// --------------------
Route::middleware(['auth', 'verified'])->group(function () {

    // Profilo utente
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Clienti
    Route::resource('clients', ClientController::class);

    // Appuntamenti
    Route::resource('appointments', AppointmentController::class);

    // Conversazioni
    Route::resource('conversations', ConversationController::class);

    // Simulatore reddito
    Route::get('/simulator', [SimulatorController::class, 'form'])->name('simulator.form');
    Route::post('/simulator', [SimulatorController::class, 'calculate'])->name('simulator.calculate');

    // Preventivi
    Route::resource('quotes', QuoteController::class);
    Route::post('quotes/{quote}/items', [QuoteController::class, 'addItem'])->name('quotes.items.add');
    Route::delete('quotes/{quote}/items/{item}', [QuoteController::class, 'removeItem'])->name('quotes.items.remove');
    Route::get('quotes/{quote}/pdf', [QuoteController::class, 'downloadPdf'])->name('quotes.downloadPdf');

    // --------------------
    // Upgrade a PRO
    // --------------------

    // Pagina upgrade (GET)
    Route::get('/upgrade', function () {
        $user = auth()->user();
        return view('upgrade', compact('user'));
    })->name('upgrade');

    // Stripe Checkout (POST) -> ritorna JSON
    Route::post('/upgrade/pro', function (Request $request) {
        $user = auth()->user();

        if ($user->plan === 'pro') {
            return response()->json(['error' => 'Sei già un utente PRO!']);
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $checkout_session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'Upgrade a PRO',
                    ],
                    'unit_amount' => 499, // prezzo in centesimi 
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('upgrade.success'),
            'cancel_url' => route('upgrade.cancel'),
        ]);

        // Ritorna JSON con session ID
        return response()->json(['id' => $checkout_session->id]);
    })->name('upgrade.pro');

    // Success dopo pagamento
    Route::get('/upgrade/success', function () {
        $user = auth()->user();
        $user->plan = 'pro';
        $user->save();

        return redirect()->route('upgrade')->with('success', '🎉 Sei diventato un utente PRO! Clienti illimitati attivati.');
    })->name('upgrade.success');

    // Cancel pagamento
    Route::get('/upgrade/cancel', function () {
        return redirect()->route('upgrade')->with('info', 'Pagamento annullato. Non sei diventato PRO.');
    })->name('upgrade.cancel');
});

// --------------------
// Autenticazione
// --------------------
require __DIR__.'/auth.php';






