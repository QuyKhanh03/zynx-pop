<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;

class DeviceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $devices = [
            ['name' => 'Desktop'],
            ['name' => 'Mobile - Android'],
            ['name' => 'Mobile - iOS'],
            ['name' => 'Tablet - Android'],
            ['name' => 'Tablet - iOS'],
            ['name' => 'Smart TV'],
            ['name' => 'Console'],
            ['name' => 'Wearable - Android'],
            ['name' => 'Wearable - iOS'],
            ['name' => 'Windows Phone'],
            ['name' => 'BlackBerry'],
            ['name' => 'Linux'],
            ['name' => 'macOS'],
            ['name' => 'Windows'],
            ['name' => 'Other']
        ];

        foreach ($devices as $device) {
            Device::create($device);
        }
    }
}
