<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Quote;

class Client extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    // associare un cliente a un utente
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relazione con preventivi
    public function quotes()
    {
        return $this->hasMany(Quote::class);
    }
}

