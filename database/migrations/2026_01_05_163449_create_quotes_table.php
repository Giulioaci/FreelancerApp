<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();

            $table->string('numero')->unique();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();

            $table->date('data_emissione');
            $table->date('data_scadenza');

            $table->enum('stato', [
                'bozza',
                'inviato',
                'accettato',
                'rifiutato'
            ])->default('bozza');

            $table->decimal('subtotale', 10, 2)->default(0);
            $table->decimal('sconto', 10, 2)->default(0);
            $table->decimal('totale', 10, 2)->default(0);

            $table->text('note')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
