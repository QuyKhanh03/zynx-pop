<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timeUnits = [
            [
                'name' => 'second',
                'abbreviation' => 's',
            ],
            [
                'name' => 'minute',
                'abbreviation' => 'm',
            ],
            [
                'name' => 'hour',
                'abbreviation' => 'h',
            ],
            [
                'name' => 'day',
                'abbreviation' => 'd',
            ],
        ];

        foreach ($timeUnits as $timeUnit) {
            \App\Models\TimeUnit::create($timeUnit);
        }
    }
}
