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
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id', 200)->primary(); // Maximaal 200 tekens voor de session ID
            $table->foreignId('user_id')->nullable()->index(); // User ID
            $table->string('ip_address', 200)->nullable(); // Maximaal 200 tekens voor het IP-adres
            $table->string('user_agent', 200)->nullable(); // Maximaal 200 tekens voor de user agent
            $table->text('payload')->nullable(); // Payload kan langer zijn, geen beperking toegevoegd
            $table->integer('last_activity')->index(); // Laatste activiteit (int, geen limiet nodig)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};