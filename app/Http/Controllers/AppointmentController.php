<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Mostra la lista degli appuntamenti dell'utente
     */
    public function index()
    {
        $appointments = Auth::user()->appointments()->with('client')->get();

        return view('appointments.index', compact('appointments'));
    }

    /**
     * Mostra il form per creare un nuovo appuntamento
     */
    public function create()
    {
        $clients = Auth::user()->clients; // solo clienti dell'utente
        return view('appointments.create', compact('clients'));
    }

    /**
     * Salva un nuovo appuntamento
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id',
            'description' => 'nullable|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after_or_equal:start_datetime',
            'location' => 'nullable|string|max:255',
        ]);

        Auth::user()->appointments()->create($request->all());

        return redirect()->route('appointments.index')->with('success', 'Appointment successfully saved!');
    }

    /**
     * Mostra il form di modifica di un appuntamento
     */
    public function edit(Appointment $appointment)
    {
        // Controllo che l'appuntamento appartenga all'utente
        if ($appointment->user_id !== Auth::id()) {
            abort(403);
        }

        $clients = Auth::user()->clients;
        return view('appointments.edit', compact('appointment', 'clients'));
    }

    /**
     * Aggiorna un appuntamento
     */
    public function update(Request $request, Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id',
            'description' => 'nullable|string',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after_or_equal:start_datetime',
            'location' => 'nullable|string|max:255',
        ]);

        $appointment->update($request->all());

        return redirect()->route('appointments.index')->with('success', 'Appointment successfully updated!');
    }

    /**
     * Elimina un appuntamento
     */
    public function destroy(Appointment $appointment)
    {
        if ($appointment->user_id !== Auth::id()) {
            abort(403);
        }

        $appointment->delete();

        return redirect()->route('appointments.index')->with('success', 'Appointment successfully deleted!');
    }
}




