<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Browser;

class BrowserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $browsers = [
            ['name' => 'Chrome'],
            ['name' => 'Firefox'],
            ['name' => 'Safari'],
            ['name' => 'Edge'],
            ['name' => 'Internet Explorer'],
            ['name' => 'Opera'],
            ['name' => 'Samsung Internet'],
            ['name' => 'UC Browser'],
            ['name' => 'Brave'],
            ['name' => 'Vivaldi'],
            ['name' => 'Other']
        ];

        foreach ($browsers as $browser) {
            Browser::create($browser);
        }
    }
}
