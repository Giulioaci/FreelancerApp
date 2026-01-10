<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Client;
use App\Models\QuoteItem;

class Quote extends Model
{
    protected $fillable = [
        'numero',
        'client_id',
        'data_emissione',
        'data_scadenza',
        'stato',
        'subtotale',
        'sconto',
        'totale',
        'note',
    ];

    protected $casts = [
        'data_emissione' => 'date',
        'data_scadenza' => 'date',
        'subtotale' => 'decimal:2',
        'sconto' => 'decimal:2',
        'totale' => 'decimal:2',
    ];

    /* =====================
       RELAZIONI
    ===================== */

    // Un preventivo appartiene a un cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Un preventivo ha molte righe
    public function items()
    {
        return $this->hasMany(QuoteItem::class);
    }

    /* =====================
       SCOPES UTILI
    ===================== */

    // Per prendere solo i preventivi in bozza
    public function scopeBozza($query)
    {
        return $query->where('stato', 'bozza');
    }

    // Per prendere solo i preventivi accettati
    public function scopeAccettati($query)
    {
        return $query->where('stato', 'accettato');
    }
}

