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

        \App\Models\Service::create([
            'name' => 'Gigi',
            'service_photo_path' => env('APP_URL') . '/storage/assets/service/Tooth.jpg'
        ]);
        \App\Models\Service::create([
            'name' => 'Kesehatan',
            'service_photo_path' => env('APP_URL') . '/storage/assets/service/Fever.jpg'

        ]);
        \App\Models\Service::create([
            'name' => 'Kandungan',
            'service_photo_path' => env('APP_URL') . '/storage/assets/service/Pregnant.jpg'

        ]);

        \App\Models\QueueStatus::create([
            'slug' => 'in-prosess',
            'status' => 'In Prosess'
        ]);
        \App\Models\QueueStatus::create([
            'slug' => 'past',
            'status' => 'Selesai'
        ]);
        \App\Models\QueueStatus::create([
            'slug' => 'canceled',
            'status' => 'Canceled'
        ]);
    }
}
