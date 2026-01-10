<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;  // Assicurati che questa riga sia presente

class IncomeSimulation extends Model
{
    use HasFactory;

    protected $fillable = ['clients', 'hours_per_client', 'hourly_rate', 'monthly_income', 'annual_income'];
}


