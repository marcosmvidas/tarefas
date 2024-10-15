<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Utilizando firstOrCreate para evitar duplicações
        Role::firstOrCreate(['name' => 'gestor']);
        Role::firstOrCreate(['name' => 'usuario']);
    }
}
