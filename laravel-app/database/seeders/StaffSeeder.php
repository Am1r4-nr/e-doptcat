<?php

namespace Database\Seeders;

use App\Models\Staff;
use Illuminate\Database\Seeder;

class StaffSeeder extends Seeder
{
    public function run(): void
    {
        Staff::truncate();

        $committee = [
            // Executive
            ['position' => 'President',                          'department' => 'Executive',              'name' => 'Dayana Ameerah Binti Romie',                  'phone' => '019-623 3137', 'email' => 'yasa.romie16@gmail.com'],
            ['position' => 'Vice President 1',                   'department' => 'Executive',              'name' => 'Muhammad Faiz Bin Mohd Rafie',                'phone' => '017-789 9320', 'email' => 'mohdpfaiz9876@gmail.com'],
            ['position' => 'Vice President 2',                   'department' => 'Executive',              'name' => 'Nur Elya Maisarah Binti Mohd Rani',          'phone' => '016-450 3351', 'email' => 'aur25elya@gmail.com'],
            ['position' => 'Secretary',                          'department' => 'Executive',              'name' => 'Nur Hamizah Fitriah Binti Thalib',           'phone' => '013-570 8683', 'email' => 'mizakhalib02@gmail.com'],
            ['position' => 'Assistant Secretary',                'department' => 'Executive',              'name' => 'Adam Mughriz Bin Alwin Aswad',               'phone' => '017-452 6119', 'email' => 'adammuqhriz230705@gmail.com'],
            ['position' => 'Financial Controller',               'department' => 'Executive',              'name' => 'Mohamad Farish Aiman Bin Mohd Azmi',         'phone' => '011-5555 2833', 'email' => 'mohamadfarishaiman@gmail.com'],
            ['position' => 'Assistant Financial Controller',     'department' => 'Executive',              'name' => 'Muhammad Raziq Syamawi Bin Ridzuan',         'phone' => '011-6336 3272', 'email' => 'rcorziq@gmail.com'],

            // Public Relations
            ['position' => 'Head of Public Relations',           'department' => 'Public Relations',      'name' => 'Nur Farisyah Zaini',                         'phone' => '011-5343 2446', 'email' => 'nurfarisyahzaini@gmail.com'],
            ['position' => 'Assistant 1 of Public Relations',   'department' => 'Public Relations',      'name' => 'Nur Umaira Binti Roslan',                    'phone' => '010-429 6311', 'email' => 'roslanumeira@gmail.com'],
            ['position' => 'Assistant 2 of Public Relations',   'department' => 'Public Relations',      'name' => 'Muhammad Faris Syahmi Bin Mohd Fitri',       'phone' => '013-961 1764', 'email' => 'fsyahmimi2710@gmail.com'],

            // Media and Design
            ['position' => 'Head of Media and Design',           'department' => 'Media and Design',      'name' => 'Nur Arisah Aishah Binti Nor Azman',          'phone' => '011-6404 6453', 'email' => 'nurarisahaishah@gmail.com'],
            ['position' => 'Assistant 1 of Media and Design',   'department' => 'Media and Design',      'name' => 'Asfa Alia Binti Asmon',                      'phone' => '013-775 0157', 'email' => 'asfaalia2006@gmail.com'],
            ['position' => 'Assistant 2 of Media and Design',   'department' => 'Media and Design',      'name' => 'Nursyafiqah Auni Bt Abdullah',               'phone' => '011-280 65293', 'email' => 'sunifuzilli@gmail.com'],
            ['position' => 'Assistant 3 of Media and Design',   'department' => 'Media and Design',      'name' => 'Nuha Maysarah Bt Mohd Bahroddin',            'phone' => '010-502 1502', 'email' => 'nuhamaysarah@gmail.com'],

            // Entrepreneurship
            ['position' => 'Head of Entrepreneurship',           'department' => 'Entrepreneurship',      'name' => 'Fatin Auni Binti Nor Rasid',                 'phone' => '016-200 6961', 'email' => 'fatinaaueni@gmail.com'],
            ['position' => 'Assistant 1 of Entrepreneurship',   'department' => 'Entrepreneurship',      'name' => 'Abid Danish Haqeem Bin Noor Hashim',         'phone' => '013-334 1835', 'email' => 'haqeem1822@gmail.com'],
            ['position' => 'Assistant 2 of Entrepreneurship',   'department' => 'Entrepreneurship',      'name' => 'Muhammad Naqeeb Bin Mohammad Soederman',    'phone' => '017-879 7383', 'email' => 'naqeebsoederman@gmail.com'],
            ['position' => 'Assistant 3 of Entrepreneurship',   'department' => 'Entrepreneurship',      'name' => 'Aina Nathasya Binti Mohd Arif',              'phone' => '011-5554 3272', 'email' => 'aina.nat05@gmail.com'],

            // Shelter and Catfeeding
            ['position' => 'Head of Shelter and Catfeeding',     'department' => 'Shelter and Catfeeding','name' => 'Nur Farahani Binti Rino Harris',              'phone' => '012-458 6344', 'email' => 'farahanoy06@gmail.com'],
            ['position' => 'Assistant 1 of Shelter and Catfeeding','department' => 'Shelter and Catfeeding','name' => 'Siti Khadijah Binti Sa\'adon',             'phone' => '011-6374 7340', 'email' => 'stihdijah@gmail.com'],
            ['position' => 'Assistant 2 of Shelter and Catfeeding','department' => 'Shelter and Catfeeding','name' => 'Muhammad Izzat Aqqram Bin Roslin',         'phone' => '013-2244 847', 'email' => 'izzataqqram@gmail.com'],
            ['position' => 'Assistant 3 of Shelter and Catfeeding','department' => 'Shelter and Catfeeding','name' => 'Muhammad Hafiy Bin Faizal',                'phone' => '013-683 1038', 'email' => 'muhafiy28@gmail.com'],

            // Rescue and Adoption
            ['position' => 'Head of Rescue and Adoption',        'department' => 'Rescue and Adoption',   'name' => 'Nur Aisha Madiha Binti Muhamad',             'phone' => '011-6416 5275', 'email' => 'aishamadiiha780@gmail.com'],
            ['position' => 'Assistant 1 of Rescue and Adoption','department' => 'Rescue and Adoption',   'name' => 'Danish Wafiq Bin Mohd Nor Shafie',           'phone' => '017-327 7170', 'email' => 'danishwafiq34@gmail.com'],
            ['position' => 'Assistant 2 of Rescue and Adoption','department' => 'Rescue and Adoption',   'name' => 'Puteri Damia Balqis Binti Muhamad Yusri',   'phone' => '011-812 0850', 'email' => 'dbalqismis1209@gmail.com'],
            ['position' => 'Assistant 3 of Rescue and Adoption','department' => 'Rescue and Adoption',   'name' => 'Adam Mu\'az Bin Mohd Hamzah',                'phone' => '011-2835 3047', 'email' => 'adampm06@gmail.com'],

            // Volunteer and Training
            ['position' => 'Head of Volunteer and Training',     'department' => 'Volunteer and Training','name' => 'Muhammad Arif Bin Abdullah',                 'phone' => '019-606 8345', 'email' => 'arif2006a@gmail.com'],
            ['position' => 'Assistant 1 of Volunteer and Training','department' => 'Volunteer and Training','name' => 'Nur Hidayah Aqilah Binti Mohd Faizal',    'phone' => '016-655 6108', 'email' => 'dayahone7@gmail.com'],
            ['position' => 'Assistant 2 of Volunteer and Training','department' => 'Volunteer and Training','name' => 'Zarul Ameera Binti Khir Badrul',           'phone' => '011-1085 8316', 'email' => 'ameerakhbm@gmail.com'],
            ['position' => 'Assistant 3 of Volunteer and Training','department' => 'Volunteer and Training','name' => 'Khairunnadian Zulkifli',                   'phone' => '013-507 0378', 'email' => 'NadiaZulkifli6@yahoo.com'],
        ];

        foreach ($committee as $member) {
            Staff::create(array_merge($member, ['type' => 'committee']));
        }
    }
}
