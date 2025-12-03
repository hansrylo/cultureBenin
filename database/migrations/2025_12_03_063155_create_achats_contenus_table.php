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
        Schema::create('achats_contenus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_utilisateur')->constrained('utilisateurs', 'id_utilisateur')->onDelete('cascade');
            $table->foreignId('id_contenu')->constrained('contenus', 'id_contenu')->onDelete('cascade');
            $table->foreignId('id_paiement')->constrained('paiements', 'id_paiement')->onDelete('cascade');
            $table->timestamp('date_achat')->useCurrent();
            $table->timestamps();
            
            // Un utilisateur ne peut acheter un contenu qu'une seule fois
            $table->unique(['id_utilisateur', 'id_contenu']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achats_contenus');
    }
};
