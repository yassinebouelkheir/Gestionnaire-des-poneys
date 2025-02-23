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
        Schema::create('historique', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('mois'); 
            $table->integer('année');
            $table->decimal('total', 10, 2);
            $table->integer('heures')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique');
    }
};
