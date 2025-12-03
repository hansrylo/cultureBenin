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
        Schema::create('parler', function (Blueprint $table) {
            $table->foreignId('id_region')->constrained('regions', 'id_region');
            $table->foreignId('id_langue')->constrained('langues', 'id_langue');
            $table->primary(['id_region', 'id_langue']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parler');
    }
};
