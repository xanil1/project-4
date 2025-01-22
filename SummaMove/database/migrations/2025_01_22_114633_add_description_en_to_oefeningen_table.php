<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('oefening', function (Blueprint $table) { // Gebruik hier de juiste tabelnaam
            $table->text('description_en')->nullable()->after('description');
        });
    }

    public function down()
    {
        Schema::table('oefening', function (Blueprint $table) { // Gebruik hier de juiste tabelnaam
            $table->dropColumn('description_en');
        });
    }

};
