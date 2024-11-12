<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Camera;

class CameraSeeder extends Seeder
{
    public function run()
    {
        Camera::create([
            'name' => 'Cámara 1',
            'latitude' => 19.3133,
            'longitude' => -98.2400,
        ]);

        Camera::create([
            'name' => 'Cámara 2',
            'latitude' => 19.3140,
            'longitude' => -98.2415,
        ]);

        Camera::create([
            'name' => 'Cámara 3',
            'latitude' => 19.3150,
            'longitude' => -98.2420,
        ]);

        Camera::create([
            'name' => 'Cámara 4',
            'latitude' => 19.3135,
            'longitude' => -98.2395,
        ]);

        Camera::create([
            'name' => 'Cámara 5',
            'latitude' => 19.3160,
            'longitude' => -98.2440,
        ]);
    }
}
