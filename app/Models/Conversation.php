<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',    // aggiunto per la foreign key
        'client_name',  
        'note',
        'decision',
        'attachment',
    ];

    // Relazione opzionale col cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}


