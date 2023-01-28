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
        $this->call(MasterLocationSeed::class);
        $this->call(MasterCategorySeed::class);
        $this->call(MasterTransactionSeed::class);
    }
}
