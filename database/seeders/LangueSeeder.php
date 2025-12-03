<?php

namespace Database\Seeders;

use App\Models\Langue;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LangueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Langue::Create([
            'nom_langue'=>'Minan',
            'code_langue'=>'Mn',
            'description'=>''
        ]);
        Langue::Create([
            'nom_langue'=>'Dendi',
            'code_langue'=>'De',
            'description'=>''
        ]);
        Langue::Create([
            'nom_langue'=>'Nago',
            'code_langue'=>'Ng',
            'description'=>''
        ]);

    
    }
}
