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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id('id_paiement');
            $table->foreignId('id_utilisateur')->constrained('utilisateurs', 'id_utilisateur')->onDelete('cascade');
            $table->foreignId('id_contenu')->constrained('contenus', 'id_contenu')->onDelete('cascade');
            $table->decimal('montant', 10, 2);
            $table->string('devise', 3)->default('XOF');
            $table->enum('statut', ['en_attente', 'reussi', 'echoue', 'rembourse'])->default('en_attente');
            $table->string('methode_paiement')->nullable(); // mobile_money, carte_bancaire
            $table->string('fedapay_transaction_id')->unique()->nullable();
            $table->string('fedapay_status')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('date_paiement')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
