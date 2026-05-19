<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear primero los datos relacionados
        \App\Models\Army_corp::factory(10)->create();
        \App\Models\Quater::factory(10)->create();
        \App\Models\Company::factory(10)->create();
        \App\Models\Service::factory(10)->create();

        // Luego crear los Soldiers con las relaciones
        \App\Models\Soldier::factory(100)->create();
    }
}
