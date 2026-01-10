<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conversation;
use Illuminate\Support\Facades\Storage;

class ConversationController extends Controller
{
    // Mostra tutte le conversazioni
    public function index() {
        $conversations = Conversation::orderBy('created_at', 'desc')->get();
        return view('conversations.index', compact('conversations'));
    }

    // Mostra il form per inserire una nuova conversazione
    public function create() {
        return view('conversations.create');
    }

    // Salva la nuova conversazione
    public function store(Request $request) {
        // Validazione dei campi
        $request->validate([
            'client_name' => 'required|string|max:255',
            'note' => 'required|string',
            'decision' => 'nullable|string',
            'attachment' => 'nullable|file|max:2048',
        ]);

        // Salva l'allegato se presente
        $path = $request->file('attachment')?->store('attachments');

        // Salva la conversazione nel database
        Conversation::create([
            'client_id' => $request->client_id,  // opzionale, se hai client_id nel form
            'client_name' => $request->client_name,
            'note' => $request->note,
            'decision' => $request->decision,
            'attachment' => $path,
        ]);

        return redirect()->route('conversations.index')
                         ->with('success', 'Conversazione salvata con successo!');
    }

    // Mostra il form per modificare una conversazione
    public function edit(Conversation $conversation) {
        return view('conversations.edit', compact('conversation'));
    }

    // Aggiorna la conversazione
    public function update(Request $request, Conversation $conversation) {
        $request->validate([
            'client_name' => 'required|string|max:255',
            'note' => 'required|string',
            'decision' => 'nullable|string',
            'attachment' => 'nullable|file|max:2048',
        ]);

        // Gestione allegato: se c'è un nuovo file, cancella il vecchio
        if ($request->hasFile('attachment')) {
            if ($conversation->attachment) {
                Storage::delete($conversation->attachment);
            }
            $conversation->attachment = $request->file('attachment')->store('attachments');
        }

        $conversation->update([
            'client_name' => $request->client_name,
            'note' => $request->note,
            'decision' => $request->decision,
        ]);

        return redirect()->route('conversations.index')
                         ->with('success', 'Conversazione aggiornata con successo!');
    }

    // Elimina la conversazione
    public function destroy(Conversation $conversation) {
        // Cancella l'allegato se esiste
        if ($conversation->attachment) {
            Storage::delete($conversation->attachment);
        }

        $conversation->delete();

        return redirect()->route('conversations.index')
                         ->with('success', 'Conversazione eliminata con successo!');
    }
}






