<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IncomeSimulation;

class SimulatorController extends Controller
{
    // Mostra il form del simulatore
    public function form() {
        return view('simulator.form');
    }

    // Calcola il reddito stimato e salva (opzionale)
    public function calculate(Request $request) {
        $request->validate([
            'clients' => 'required|integer',
            'hours_per_client' => 'required|integer',
            'hourly_rate' => 'required|numeric'
        ]);

        $monthly = $request->clients * $request->hours_per_client * $request->hourly_rate;
        $annual = $monthly * 12;

        // Salva la simulazione
        IncomeSimulation::create([
            'clients' => $request->clients,
            'hours_per_client' => $request->hours_per_client,
            'hourly_rate' => $request->hourly_rate,
            'monthly_income' => $monthly,
            'annual_income' => $annual
        ]);

        return view('simulator.result', compact('monthly','annual'));
    }
}
