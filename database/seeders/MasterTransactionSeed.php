<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterTransactionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MasterTransaction::create(
            [
                'alias' => 'delivery',
                'title' => 'Delivery'
            ],
            [
                'alias' => 'drive-thru',
                'title' => 'Drive Thru'
            ],
            [
                'alias' => 'pickup',
                'title' => 'Pickup'
            ],
            [
                'alias' => 'dine-in',
                'title' => 'Dine In'
            ]
        );
    }
}
