<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DealerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dealers =[
            [
                'name'=> 'Patenga Traders',
                'address'=> 'KEPZ',
                'mobile'=> '0123456789',
                'jar_limit'=> '400',
            ],
            [
                'name'=> 'Nur Traders',
                'address'=> 'Mohora',
                'mobile'=> '0123456789',
                'jar_limit'=> '50',
            ],
            [
                'name'=> 'AKF Traders',
                'address'=> 'Office',
                'mobile'=> '0123456789',
                'jar_limit'=> '100',
            ],
            [
                'name'=> 'Habib Traders',
                'address'=> 'BaddarHat',
                'mobile'=> '0123456789',
                'jar_limit'=> '50',
            ],

        ];

        // Insert multiple records into the 'dealers' table
        DB::table('dealers')->insert($dealers);
    }
}
