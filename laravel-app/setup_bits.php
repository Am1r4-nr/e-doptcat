<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use App\Models\Cat;
use App\Models\GpsDevice;

$cat = Cat::firstOrCreate(['name' => 'Bits'], ['description' => 'GPS tracker test cat']);
echo "✓ Cat 'Bits' created/found with ID: " . $cat->id . PHP_EOL;

$device = GpsDevice::firstOrCreate(
    ['imei' => '861261022286138'], 
    ['cat_id' => $cat->id, 'device_name' => 'Bits GPS Device', 'is_active' => true]
);
echo "✓ GPS Device created: IMEI " . $device->imei . " -> Cat 'Bits' (ID: " . $device->cat_id . ")" . PHP_EOL;
echo "" . PHP_EOL;
echo "Ready! Now you can test with:" . PHP_EOL;
echo "  GET  http://localhost:8000/api/gps/location?imei=861261022286138" . PHP_EOL;
echo "  POST http://localhost:8000/api/gps/location/save" . PHP_EOL;
