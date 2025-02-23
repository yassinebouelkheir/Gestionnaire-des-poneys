<?php

namespace Database\Seeders;

use App\Models\Historique;
use Illuminate\Database\Seeder;

class HistoriqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Historique::factory()
            ->count(5)
            ->create();

        Historique::create([
            'nom' => 'Z\'amis des Z\'animaux',
            'mois' => 'Février',
            'année' => 2025,
            'total' => 1000,
            'jours' => 10
        ]);
    }
}
