<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $offers = [
            [
                'name' => 'chapmanganato.to - Propeller',
                'direct_link' => 'https://ak.aimukreegee.net/4/7929521',
                'description' => 'Description for chapmanganato.to - Propeller',
                'status' => 'active',
                'partner' => 'Propeller',
            ],
            [
                'name' => 'chapmanganato.to - Adsterra',
                'direct_link' => 'https://suitedeatercrutch.com/r9i22iht?key=d650e254b83e0f36d9c01cc170be806b',
                'description' => 'Description for chapmanganato.to - Adsterra',
                'status' => 'active',
                'partner' => 'Adsterra',
            ],
            [
                'name' => 'chapmanganato.to - Galaksion',
                'direct_link' => 'https://highmanapts.com/iZncPX84FBeVr/105324',
                'description' => 'Description for chapmanganato.to - Galaksion',
                'status' => 'active',
                'partner' => 'Galaksion',
            ],

        ];

        foreach ($offers as $offer) {
            \App\Models\Offer::create($offer);
        }

    }
}
