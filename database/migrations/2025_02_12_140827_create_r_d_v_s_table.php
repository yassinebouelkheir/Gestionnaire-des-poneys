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
        Schema::create('rendez_vous', function (Blueprint $table) {
            $table->id();
            $table->string('nom_client');
            $table->integer('heures');
            $table->integer('prix');
            $table->integer('personnes');
            $table->timestamp('date_time');
            $table->integer('poney_1');
            $table->integer('poney_2');
            $table->integer('poney_3');
            $table->integer('poney_4');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendez_vous');
    }
};
