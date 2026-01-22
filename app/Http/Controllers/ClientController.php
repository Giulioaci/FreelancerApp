<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    /**
     * Mostra la lista dei clienti
     */
    public function index()
    {
        $user = Auth::user();
        $clients = $user->clients()->get();

        return view('clients.index', compact('clients', 'user'));
    }

    /**
     * Mostra il form di creazione
     */
    public function create()
    {
        $user = Auth::user();

        if ($user->hasReachedClientLimit()) {
            return redirect()
                ->route('clients.index')
                ->with('error', 'Hai raggiunto il limite di 5 clienti. Passa al piano PRO per clienti illimitati.');
        }

        return view('clients.create');
    }

    /**
     * Salva un nuovo cliente
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->hasReachedClientLimit()) {
            return redirect()
                ->route('clients.index')
                ->with('error', 'Hai raggiunto il limite di 5 clienti. Passa al piano PRO per clienti illimitati.');
        }

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients,email',
            'phone' => 'nullable|string|max:50|unique:clients,phone',
        ], [
            'phone.unique' => 'Questo numero di telefono è già stato inserito.',
            'email.unique' => 'Questa email è già stata inserita.',
        ]);

        $user->clients()->create($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Cliente salvato correttamente!');
    }

    /**
     * Mostra il form di modifica
     */
    public function edit(Client $client)
    {
        $user = Auth::user();

        // 🔒 Controllo: il cliente deve appartenere all'utente
        if ($client->user_id !== $user->id) {
            abort(403, 'Operazione non autorizzata.');
        }

        return view('clients.edit', compact('client', 'user'));
    }

    /**
     * Aggiorna il cliente
     */
    public function update(Request $request, Client $client)
    {
        $user = Auth::user();

        if ($client->user_id !== $user->id) {
            abort(403, 'Operazione non autorizzata.');
        }

        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'nullable|email|unique:clients,email,' . $client->id,
            'phone' => 'nullable|string|max:50|unique:clients,phone,' . $client->id,
        ], [
            'phone.unique' => 'Questo numero di telefono è già stato inserito.',
            'email.unique' => 'Questa email è già stata inserita.',
        ]);

        $client->update($validated);

        return redirect()
            ->route('clients.index')
            ->with('success', 'Cliente aggiornato correttamente!');
    }

    /**
     * Elimina il cliente
     */
    public function destroy(Client $client)
    {
        $user = Auth::user();

        if ($client->user_id !== $user->id) {
            abort(403, 'Operazione non autorizzata.');
        }

        $client->delete();

        return redirect()
            ->route('clients.index')
            ->with('success', 'Cliente eliminato correttamente!');
    }
}




