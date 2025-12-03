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
        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->id('id_utilisateur');
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('mot_de_passe');
            $table->enum('sexe', ['M', 'F', 'Autre'])->nullable();
            $table->unsignedBigInteger('role');
            $table->unsignedBigInteger('id_langue');
            $table->timestamp('date_inscription')->useCurrent();
            $table->date('date_naissance')->nullable();
            $table->enum('statut', ['actif', 'inactif', 'banni'])->default('actif');
            $table->string('photo')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
            
            // Clés étrangères
            $table->foreign('role')->references('id_role')->on('roles');
            $table->foreign('id_langue')->references('id_langue')->on('langues');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
