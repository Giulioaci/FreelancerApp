<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Preventivo #{{ $quote->numero }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 5px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Preventivo #{{ $quote->numero }}</h2>
    <p><strong>Cliente:</strong> {{ $quote->client->name }}</p>
    <p><strong>Data Emissione:</strong> {{ $quote->data_emissione->format('d/m/Y') }}</p>
    <p><strong>Data Scadenza:</strong> {{ $quote->data_scadenza->format('d/m/Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Descrizione</th>
                <th>Quantità</th>
                <th>Prezzo Unitario</th>
                <th>Totale</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quote->items as $item)
            <tr>
                <td>{{ $item->descrizione }}</td>
                <td>{{ $item->quantita }}</td>
                <td>{{ number_format($item->prezzo_unitario, 2, ',', '.') }} €</td>
                <td>{{ number_format($item->totale, 2, ',', '.') }} €</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Totale: {{ number_format($quote->totale, 2, ',', '.') }} €</h3>
</body>
</html>
