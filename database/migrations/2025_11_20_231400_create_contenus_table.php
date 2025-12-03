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
        Schema::create('contenus', function (Blueprint $table) {
            $table->id('id_contenu');
            $table->string('titre');
            $table->foreignId('id_type')->constrained('type_contenus', 'id_type');
            $table->text('texte');
            $table->dateTime('date_creation');
            $table->string('statut');
            $table->foreignId('id_auteur')->constrained('utilisateurs', 'id_utilisateur');
            $table->foreignId('id_langue')->constrained('langues', 'id_langue');
            $table->foreignId('id_region')->constrained('regions', 'id_region');
            $table->foreignId('parent')->nullable()->constrained('contenus', 'id_contenu');
            $table->foreignId('id_moderateur')->nullable()->constrained('utilisateurs', 'id_utilisateur');
            $table->dateTime('date_validation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contenus');
    }
};
