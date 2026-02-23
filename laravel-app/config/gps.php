<?php

return [
    /*
    |--------------------------------------------------------------------------
    | 365GPS Tracker Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for connecting to 365GPS tracking service
    |
    */

    'tracker_api_url' => env('GPS_TRACKER_API_URL', 'http://www.365gps.net/wx_ilist.php'),
    
    'tracker_imei' => env('GPS_TRACKER_IMEI', ''),
    
    'tracker_password' => env('GPS_TRACKER_PASSWORD', ''),
    
    'tracker_api_key' => env('GPS_TRACKER_API_KEY', ''),
    
    'tracker_api_version' => env('GPS_TRACKER_API_VERSION', '1.41'),

    'sync_interval' => env('GPS_SYNC_INTERVAL', 5),

    'auto_sync_enabled' => env('GPS_AUTO_SYNC_ENABLED', true),
];
