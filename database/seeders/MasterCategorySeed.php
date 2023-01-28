<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MasterCategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\MasterCategory::create(
            [
                'alias' => 'bakeries',
                'title' => 'Bakeries'
            ],
            [
                'alias' => 'pizza',
                'title' => 'Pizza'
            ],
            [
                'alias' => 'halal',
                'title' => 'Halal'
            ],
            [
                'alias' => 'sandwiches',
                'title' => 'Sandwiches'
            ],
            [
                'alias' => 'soup',
                'title' => 'Soup'
            ]
        );
    }
}
