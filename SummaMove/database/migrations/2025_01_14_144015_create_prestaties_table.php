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
        Schema::create('prestaties', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('oefening_id');
            $table->dateTime('start_tijd');
            $table->dateTime('eind_tijd');
            $table->integer('aantal')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestaties');
    }
};
