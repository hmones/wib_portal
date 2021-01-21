<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SupportedLinksSeeder::class);
        $this->call(SectorsSeeder::class);
        $this->call(EntityTypesSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(CitiesSeeder::class);
    }
}
