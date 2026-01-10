<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Quote;

class QuoteItem extends Model
{
    protected $fillable = [
        'quote_id',
        'descrizione',
        'quantita',
        'prezzo_unitario',
        'totale',
    ];

    protected $casts = [
        'quantita' => 'decimal:2',
        'prezzo_unitario' => 'decimal:2',
        'totale' => 'decimal:2',
    ];

    // Una riga appartiene a un preventivo
    public function quote()
    {
        return $this->belongsTo(Quote::class);
    }
}

