<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::Create(['nom_role'=>'Manager']);
        Role::Create(['nom_role'=>'Lecteur']);
        Role::Create(['nom_role'=>'Auteur']);
    }   

}
