<?php

namespace Database\Seeders;

use App\Models\Cat;
use Illuminate\Database\Seeder;

class CatLocationSeeder extends Seeder
{
    public function run()
    {
        $cats = Cat::all();
        foreach ($cats as $cat) {
            $cat->update([
                'gps_lat' => 3.05 + (mt_rand() / mt_getrandmax()) * 0.2,
                'gps_lng' => 101.55 + (mt_rand() / mt_getrandmax()) * 0.2,
            ]);
        }
        echo "Updated " . $cats->count() . " cats with KL coordinates.\n";
    }
}
