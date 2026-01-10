<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;
use App\Models\Client;
use App\Models\QuoteItem;
use PDF; // Per generare PDF

class QuoteController extends Controller
{
    // Mostra lista preventivi
    public function index()
    {
        $quotes = Quote::with('client', 'items')->get();
        return view('quotes.index', compact('quotes'));
    }

    // Mostra form per creare preventivo
    public function create()
    {
        $clients = Client::all();
        return view('quotes.create', compact('clients'));
    }

    // Salva nuovo preventivo
    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'data_emissione' => 'required|date',
            'data_scadenza' => 'required|date|after_or_equal:data_emissione',
        ]);

        $quote = Quote::create([
            'numero' => 'PREV-' . time(), // numero automatico semplice
            'client_id' => $request->client_id,
            'data_emissione' => $request->data_emissione,
            'data_scadenza' => $request->data_scadenza,
            'stato' => 'bozza',
        ]);

        return redirect()->route('quotes.edit', $quote->id)
                         ->with('success', 'Quote created!');
    }

    // Mostra form per modificare preventivo + righe
    public function edit(Quote $quote)
    {
        $quote->load('items', 'client');
        return view('quotes.edit', compact('quote'));
    }

    // Aggiorna preventivo
    public function update(Request $request, Quote $quote)
    {
        $request->validate([
            'data_emissione' => 'required|date',
            'data_scadenza' => 'required|date|after_or_equal:data_emissione',
        ]);

        $quote->update([
            'data_emissione' => $request->data_emissione,
            'data_scadenza' => $request->data_scadenza,
            'note' => $request->note,
        ]);

        return redirect()->route('quotes.edit', $quote->id)
                         ->with('success', 'Quote updated!');
    }

    // Elimina preventivo
    public function destroy(Quote $quote)
    {
        $quote->delete();
        return redirect()->route('quotes.index')
                         ->with('success', 'Quote deleted!');
    }

    // Aggiungi riga al preventivo
    public function addItem(Request $request, Quote $quote)
    {
        $request->validate([
            'descrizione' => 'required|string',
            'quantita' => 'required|numeric|min:0.01',
            'prezzo_unitario' => 'required|numeric|min:0',
        ]);

        $totale = $request->quantita * $request->prezzo_unitario;

        $quote->items()->create([
            'descrizione' => $request->descrizione,
            'quantita' => $request->quantita,
            'prezzo_unitario' => $request->prezzo_unitario,
            'totale' => $totale,
        ]);

        // Ricalcolo subtotale e totale
        $quote->subtotale = $quote->items()->sum('totale');
        $quote->totale = $quote->subtotale - $quote->sconto;
        $quote->save();

        return back()->with('success', 'Item added!');
    }

    // Rimuovi riga preventivo
    public function removeItem(Quote $quote, QuoteItem $item)
    {
        $item->delete();

        $quote->subtotale = $quote->items()->sum('totale');
        $quote->totale = $quote->subtotale - $quote->sconto;
        $quote->save();

        return back()->with('success', 'Item removed!');
    }

    // Genera PDF del preventivo
    public function downloadPdf($id)
    {
        $quote = Quote::with('client', 'items')->findOrFail($id);

        $pdf = PDF::loadView('quotes.pdf', compact('quote'));

        return $pdf->download('preventivo_'.$quote->numero.'.pdf');
    }
}


