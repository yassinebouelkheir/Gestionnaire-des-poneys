<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([ 
            HistoriqueSeeder::class,
        ]);
        $this->call([ 
            UserSeeder::class,
        ]);
        $this->call([ 
            PoneySeeder::class,
        ]);
        $this->call([ 
            RDVSeeder::class,
        ]);
    }
}
