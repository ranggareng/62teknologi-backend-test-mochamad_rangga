<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class MasterLocationSeed extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $path = getcwd().'/database/seeders/adm_states.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('States table seeded!');
 
        $path = getcwd().'/database/seeders/adm_cities.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Cities table seeded!');

        $path = getcwd().'/database/seeders/adm_districts_1.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Districts table seeded!');

        $path = getcwd().'/database/seeders/adm_districts_2.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Districts table seeded!');

        $path = getcwd().'/database/seeders/adm_districts_3.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Districts table seeded!');
        
        $path = getcwd().'/database/seeders/adm_villages.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Village 0 table seeded!');

        $path = getcwd().'/database/seeders/adm_villages_1.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Village 1 table seeded!');

        $path = getcwd().'/database/seeders/adm_villages_2.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Village 2 table seeded!');

        $path = getcwd().'/database/seeders/adm_villages_3.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Village 3 table seeded!');

        $path = getcwd().'/database/seeders/adm_villages_4.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Village 4 table seeded!');

        $path = getcwd().'/database/seeders/adm_villages_5.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Village 5 table seeded!');

        $path = getcwd().'/database/seeders/adm_villages_6.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Village 6 table seeded!');

        $path = getcwd().'/database/seeders/adm_villages_7.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Village 7 table seeded!');

        $path = getcwd().'/database/seeders/adm_villages_8.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Village 8 table seeded!');

        $path = getcwd().'/database/seeders/adm_villages_9.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Village 9 table seeded!');

        $path = getcwd().'/database/seeders/adm_villages_10.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Village 10 table seeded!');

        $path = getcwd().'/database/seeders/adm_villages_11.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Village 11 table seeded!');

        $path = getcwd().'/database/seeders/adm_villages_12.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Village 12 table seeded!');

        $path = getcwd().'/database/seeders/adm_villages_13.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Village 13 table seeded!');
    }
}
