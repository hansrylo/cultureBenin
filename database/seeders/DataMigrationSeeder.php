<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataMigrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🚀 Export des données MySQL...');

        $data = [
            'utilisateurs' => \App\Models\Utilisateur::all()->toArray(),
            'type_contenus' => \App\Models\TypeContenu::all()->toArray(),
            'langues' => \App\Models\Langue::all()->toArray(),
            'regions' => \App\Models\Region::all()->toArray(),
            'contenus' => \App\Models\Contenu::all()->toArray(),
            'type_media' => \App\Models\TypeMedia::all()->toArray(),
            'medias' => \App\Models\Media::all()->toArray(),
            'commentaires' => \App\Models\Commentaire::all()->toArray(),
        ];

        // Sauvegarder dans un fichier JSON
        $filePath = database_path('data_export.json');
        file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT));

        $this->command->info("✅ Données exportées vers : {$filePath}");
        $this->command->info('📊 Statistiques :');
        foreach ($data as $table => $records) {
            $this->command->info("  - {$table}: " . count($records) . " enregistrements");
        }
    }
}
