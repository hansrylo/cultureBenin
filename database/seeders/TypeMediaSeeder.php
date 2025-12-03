<?php

namespace Database\Seeders;

use App\Models\TypeMedia;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TypeMedia::create([
            'nom_type'=>'document',
        ]);
    }
}
