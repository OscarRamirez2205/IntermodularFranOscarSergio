<?php

namespace Database\Seeders;

use App\Models\Centro;
use App\Models\Empresa;
use App\Models\Usuario;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Empresa::factory(10)->create();
        Centro::factory(10)->create();
        Usuario::factory(50)->create();
    }
}
