<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(5)
            ->create();

        User::factory()->create([
            'nom' => 'Administrateur',
            'name' => 'admin',
            'mdp' => '$2y$10$Yh.zgWLD5XzWj7DKuz.hQeFZ20AYzOBZhzda3gofoik3NGWEihNzu',
        ]);
    }
}
