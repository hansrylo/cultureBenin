<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Region::create([
            'nom_region'=>'Vedoko',
        ]);
        Region::create([
            'nom_region'=>'Akpakpa',
        ]);
        Region::create([
            'nom_region'=>'Cadjehoun',
        ]);
        Region::create([
            'nom_region'=>'Menontin',
        ]);
        Region::create([
            'nom_region'=>'kpota',
        ]);
        Region::create([
            'nom_region'=>'Tokan',
        ]);
    }
}
