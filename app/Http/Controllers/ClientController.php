<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    // Mostra la lista dei clienti
    public function index()
    {
        // Prende solo i clienti dell'utente autenticato
        $clients = Auth::user()->clients()->get();

        return view('clients.index', compact('clients'));
    }

    // Mostra il form di creazione
    public function create()
    {
        return view('clients.create');
    }

    // Salva un nuovo cliente
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name'  => 'required|string|max:255',
                'email' => 'nullable|email|unique:clients,email',
                'phone' => 'nullable|string|max:50|unique:clients,phone',
            ],
            [
                'phone.unique' => 'This phone number has already been entered.',
                'email.unique' => 'This email has already been entered.',
            ]
        );

        // Creazione tramite relazione con l'utente autenticato
        Auth::user()->clients()->create($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Customer saved successfully!');
    }

    // Mostra il form di modifica
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    // Aggiorna il cliente
    public function update(Request $request, Client $client)
    {
        $validated = $request->validate(
            [
                'name'  => 'required|string|max:255',
                'email' => 'nullable|email|unique:clients,email,' . $client->id,
                'phone' => 'nullable|string|max:50|unique:clients,phone,' . $client->id,
            ],
            [
                'phone.unique' => 'This phone number has already been entered.',
                'email.unique' => 'This email has already been entered.',
            ]
        );

        $client->update($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Customer successfully updated!');
    }

    // Elimina il cliente
    public function destroy(Client $client)
    {
        $client->delete();

        return redirect()
            ->route('clients.index')
            ->with('success', 'Customer successfully deleted!');
    }
}


