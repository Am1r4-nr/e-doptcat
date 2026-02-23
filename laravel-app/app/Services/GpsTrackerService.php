<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GpsTrackerService
{
    private $apiUrl;
    private $username;
    private $password;
    private $apiKey;

    public function __construct()
    {
        // Load 365GPS credentials from environment
        $this->apiUrl = config('gps.tracker_api_url', 'http://api.365gps.com');
        $this->username = config('gps.tracker_username');
        $this->password = config('gps.tracker_password');
        $this->apiKey = config('gps.tracker_api_key');
    }

    /**
     * Get real-time location for a device by IMEI
     * 
     * @param string $imei International Mobile Equipment Identity
     * @return array|null ['lat' => latitude, 'lng' => longitude, 'accuracy' => meters, 'timestamp' => timestamp]
     */
    public function getDeviceLocation($imei): ?array
    {
        try {
            // Method 1: Using API Key (recommended)
            if ($this->apiKey) {
                $response = Http::get("{$this->apiUrl}/gps/queryDevice", [
                    'imei' => $imei,
                    'apikey' => $this->apiKey,
                ]);
            }
            // Method 2: Using Basic Auth
            else if ($this->username && $this->password) {
                $response = Http::withBasicAuth($this->username, $this->password)
                    ->get("{$this->apiUrl}/gps/queryDevice", [
                        'imei' => $imei,
                    ]);
            }
            // Method 3: Using POST with credentials
            else {
                $response = Http::post("{$this->apiUrl}/gps/queryDevice", [
                    'imei' => $imei,
                    'username' => $this->username,
                    'password' => $this->password,
                ]);
            }

            if ($response->successful()) {
                $data = $response->json();
                
                // Parse response based on 365GPS API format
                // The exact structure depends on your device's API version
                return [
                    'lat' => $data['lat'] ?? $data['latitude'] ?? null,
                    'lng' => $data['lng'] ?? $data['longitude'] ?? null,
                    'accuracy' => $data['accuracy'] ?? null,
                    'timestamp' => $data['timestamp'] ?? $data['gpsTime'] ?? now(),
                    'speed' => $data['speed'] ?? null,
                    'direction' => $data['direction'] ?? null,
                ];
            }

            Log::warning("GPS Tracker API Error for IMEI {$imei}: " . $response->status());
            return null;

        } catch (\Exception $e) {
            Log::error("GPS Tracker Exception: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Get device history (last N locations)
     * 
     * @param string $imei
     * @param int $limit
     * @return array
     */
    public function getDeviceHistory($imei, $limit = 10)
    {
        try {
            if ($this->apiKey) {
                $response = Http::get("{$this->apiUrl}/gps/queryHistory", [
                    'imei' => $imei,
                    'apikey' => $this->apiKey,
                    'limit' => $limit,
                ]);
            } else if ($this->username && $this->password) {
                $response = Http::withBasicAuth($this->username, $this->password)
                    ->get("{$this->apiUrl}/gps/queryHistory", [
                        'imei' => $imei,
                        'limit' => $limit,
                    ]);
            } else {
                return [];
            }

            if ($response->successful()) {
                return $response->json()['data'] ?? [];
            }

            return [];

        } catch (\Exception $e) {
            Log::error("GPS History Exception: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Get location from www.365gps.net endpoint (wx_ilist.php)
     * 
     * @param string $imei Device IMEI
     * @return array|null ['lat' => latitude, 'lng' => longitude, 'accuracy' => accuracy, ...]
     */
    public function getLocation($imei = null)
    {
        try {
            $imei = $imei ?? config('gps.tracker_imei');
            $apiUrl = config('gps.tracker_api_url');
            $password = config('gps.tracker_password');
            $apiKey = config('gps.tracker_api_key');
            $apiVersion = config('gps.tracker_api_version', '1.41');
            
            Log::info("GpsTrackerService::getLocation - Calling 365GPS API", [
                'imei' => $imei,
                'url' => $apiUrl
            ]);
            
            // Build query parameters for 365GPS wx_ilist.php endpoint
            $params = [
                'imei' => $imei,
                'pw' => $password,
                'ver' => $apiVersion,
                'app' => 'wx',
                'hw' => 'iOS',
                'ak' => $apiKey,
            ];
            
            /** @var \Illuminate\Http\Client\Response $response */
            $response = Http::timeout(10)->get($apiUrl, $params);

            Log::info("GpsTrackerService::getLocation - Response Status: " . $response->status());
            
            if ($response->successful()) {
                $body = $response->body();
                
                // Remove UTF-8 BOM if present
                if (substr($body, 0, 3) === "\xEF\xBB\xBF") {
                    $body = substr($body, 3);
                }
                
                // Parse JSON
                $data = json_decode($body, true);
                
                Log::info("GpsTrackerService::getLocation - Success", ['data' => $data]);
                
                // Parse the 365GPS response format
                // The API typically returns location data in nested structure
                return $this->parse365GPSResponse($data);
            }

            Log::warning("GPS API Error for IMEI {$imei}: " . $response->status(), [
                'response_body' => $response->body()
            ]);
            return null;

        } catch (\Exception $e) {
            Log::error("GPS API Exception: " . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    /**
     * Parse 365GPS API response format
     * 
     * @param array $data Raw response from 365GPS (array of devices)
     * @return array|null Standardized location data with lat, lng, accuracy, timestamp
     */
    private function parse365GPSResponse($data): ?array
    {
        // 365GPS wx_ilist.php returns an array of devices
        // Format: [{"imei":"xxx","gps":"2026-02-22 16:19:33,13,1,0,9,3.738718,103.26262,19",...}]
        
        if (!is_array($data) || count($data) === 0) {
            return null;
        }
        
        $device = is_array($data) ? $data[0] : $data;
        
        // Parse the GPS field which contains: datetime,status,?,?,?,latitude,longitude,?
        $gpsData = $device['gps'] ?? null;
        $lat = null;
        $lng = null;
        $timestamp = null;
        
        if ($gpsData) {
            // Example: "2026-02-22 16:19:33,13,1,0,9,3.738718,103.26262,19"
            $parts = explode(',', $gpsData);
            
            if (count($parts) >= 7) {
                $timestamp = $parts[0]; // "2026-02-22 16:19:33"
                $lat = (float)$parts[5]; // 3.738718
                $lng = (float)$parts[6]; // 103.26262
            }
        }
        
        return [
            'lat' => $lat,
            'lng' => $lng,
            'accuracy' => $device['accuracy'] ?? null,
            'speed' => $device['speed'] ?? null,
            'direction' => $device['direction'] ?? null,
            'timestamp' => $timestamp ?? now(),
            'battery' => $device['bat'] ?? null,
            'device_name' => $device['name'] ?? null,
            'imei' => $device['imei'] ?? null,
            'raw' => $device,
        ];
    }

    /**
     * Test connection to 365GPS API
     */
    public function testConnection()
    {
        try {
            if ($this->apiKey) {
                $response = Http::get("{$this->apiUrl}/gps/test", [
                    'apikey' => $this->apiKey,
                ]);
            } else if ($this->username && $this->password) {
                $response = Http::withBasicAuth($this->username, $this->password)
                    ->get("{$this->apiUrl}/gps/test");
            } else {
                return false;
            }

            return $response->successful();

        } catch (\Exception $e) {
            Log::error("GPS Connection Test Failed: " . $e->getMessage());
            return false;
        }
    }
}
