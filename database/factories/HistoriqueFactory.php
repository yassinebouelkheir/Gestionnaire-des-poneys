<?php

namespace Database\Factories;

use App\Models\Historique;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoriqueFactory extends Factory
{
    protected $model = Historique::class;

    public function definition()
    {
        $frenchMonths = [
            'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
            'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'
        ];

        return [
            'nom' => fake()->company,
            'mois' => fake()->randomElement($frenchMonths),
            'année' => '2024',
            'total' => fake()->numberBetween(1000, 20000),
            'heures' => fake()->numberBetween(10, 100)
        ];
    }
}