<?php

namespace Database\Seeders;

use App\Models\Volunteer;
use Illuminate\Database\Seeder;

class VolunteerSeeder extends Seeder
{
    public function run(): void
    {
        $volunteers = [
            ['name' => 'Khairunnadiah zulkfli', 'matric' => '2513684', 'email' => 'khairunnadiahzulkfli@gmail.com', 'phone' => '195070978', 'status' => 'APPROVED'],
            ['name' => 'ZARUL AMEERA BINTI KHIR BADRUL', 'matric' => '2517178', 'email' => 'ameerakbm@gmail.com', 'phone' => '011-10858916', 'status' => 'PENDING'],
            ['name' => 'Muhammad Arif Bin Abdullah', 'matric' => '2518991', 'email' => 'arif2006a@gmail.com', 'phone' => '019-6068345', 'status' => 'PENDING'],
            ['name' => 'MUHAMMAD HARRAZ HAKIM BIN HAIRONIZAD', 'matric' => '2518787', 'email' => 'harazhakim295@gmail.com', 'phone' => '177300296', 'status' => 'PENDING'],
            ['name' => 'MUHAMMAD HASIF BIN ZOLFATTAH', 'matric' => '2511491', 'email' => 'hasifzol06@gmail.com', 'phone' => '1124402473', 'status' => 'PENDING'],
            ['name' => 'Ariyana Aisyah binti Ahmad Sabri', 'matric' => '2511630', 'email' => 'ariyanasyah04@gmail.com', 'phone' => '019-6456817', 'status' => 'PENDING'],
            ['name' => 'Muhammad Hafiy bin Faizal', 'matric' => '2510947', 'email' => 'muhafiy28@gmail.com', 'phone' => '019-6831098', 'status' => 'PENDING'],
            ['name' => 'AUDADI HARITH HAZIQ BIN ASMADI', 'matric' => '2512603', 'email' => 'harithhaziq1006@gmail.com', 'phone' => '017-4059703', 'status' => 'PENDING'],
            ['name' => 'Farah Saajidah Binti Shamuddin', 'matric' => '2519942', 'email' => 'farahsaajidah@gmail.com', 'phone' => '178206411', 'status' => 'PENDING'],
            ['name' => 'Nur Hidayah Aqilah Binti Mohd Faizal', 'matric' => '2514278', 'email' => 'dayahone7@gmail.com', 'phone' => '1165561708', 'status' => 'PENDING'],
            ['name' => 'SHARIFAH BATRISYIA BINTI SYED AZMIZI', 'matric' => '2514444', 'email' => 'sharifahbatrisyia090@gmail.com', 'phone' => '1110301801', 'status' => 'PENDING'],
            ['name' => 'Muhammad Farhan Bin Fadzli', 'matric' => '2510505', 'email' => 'paan0145@gmail.com', 'phone' => '183834145', 'status' => 'PENDING'],
            ['name' => 'Dayana Aneeqah binti Romie', 'matric' => '2411666', 'email' => 'yana.romie16@gmail.com', 'phone' => '019-6233173', 'status' => 'PENDING'],
            ['name' => 'NUR ARISAH AISHAH BINTI NOR AZMAN', 'matric' => '2422936', 'email' => 'nurarisahaishah@gmail.com', 'phone' => '1164046453', 'status' => 'PENDING'],
            ['name' => 'Muhammad Faris Syahmi Bin Mohd Fitri', 'matric' => '2510031', 'email' => 'fsyahmimi2710@gmail.com', 'phone' => '013-9617764', 'status' => 'PENDING'],
            ['name' => 'AINA NATHASYA BINTI MOHD ARIF', 'matric' => '2510877', 'email' => 'aina.nat05@gmail.com', 'phone' => '1155543272', 'status' => 'PENDING'],
            ['name' => 'Aireen Mukhlisha binti Ismail', 'matric' => '2513980', 'email' => 'aireenmukhlisha@gmail.com', 'phone' => '019-8406612', 'status' => 'PENDING'],
            ['name' => 'Muhammad Nur Adam Fitri bin Ali', 'matric' => '2417235', 'email' => 'adamfitri94444@gmail.com', 'phone' => '017-6367569', 'status' => 'PENDING'],
            ['name' => 'MUHAMMAD ABID DANISH HAQEEM BIN NOOR HASHIM', 'matric' => '2418939', 'email' => 'haqeem1822@gmail.com', 'phone' => '199941835', 'status' => 'PENDING'],
            ['name' => "SITI KHADIJAH BINTI SA'ADON", 'matric' => '2412754', 'email' => 'stkhdjahh@gmail.com', 'phone' => '011-63747340', 'status' => 'PENDING'],
        ];

        foreach ($volunteers as $data) {
            $data['name'] = ucwords(strtolower($data['name']));
            Volunteer::firstOrCreate(
                ['matric' => $data['matric']],
                array_merge($data, ['applied_at' => now()])
            );
        }
    }
}
