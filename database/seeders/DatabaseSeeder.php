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
        \App\Models\User::factory(1)->create(['email' => 'mochamad.rangga@gmail.com']);
        $this->call(MasterLocationSeed::class);
        $this->call(MasterCategorySeed::class);
        $this->call(MasterTransactionSeed::class);
    }
}
