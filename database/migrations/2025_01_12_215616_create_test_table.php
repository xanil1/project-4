<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestTable extends Migration
{
    /**
     * Voer de migratie uit.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name'); // Een stringkolom voor de naam
            $table->integer('age'); // Een integerkolom voor leeftijd
            $table->boolean('is_active')->default(true); // Een booleankolom voor actieve status
            $table->timestamps(); // Maakt de kolommen 'created_at' en 'updated_at'
        });
    }

    /**
     * Zet de migratie terug.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test');
    }
}