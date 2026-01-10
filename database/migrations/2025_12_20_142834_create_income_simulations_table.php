<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('income_simulations', function (Blueprint $table) {
            $table->id();  // Colonna id automatica
            $table->integer('clients');  // Colonna per il numero di clienti
            $table->integer('hours_per_client');  // Colonna per le ore per cliente
            $table->decimal('hourly_rate', 8, 2);  // Colonna per la tariffa oraria
            $table->decimal('monthly_income', 10, 2);  // Colonna per il reddito mensile
            $table->decimal('annual_income', 10, 2);  // Colonna per il reddito annuale
            $table->timestamps();  // Colonne per data di creazione e aggiornamento
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('income_simulations');
    }
};

