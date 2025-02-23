<?php

namespace Database\Seeders;

use App\Models\Poney;
use Illuminate\Database\Seeder;

class PoneySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Poney::factory()
            ->count(5)
            ->create();
    }
}
