<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $users=[
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('12345678'),
            ],
           [
               'name' => 'Admin',
               'email' => 'admin@gmail.com',
               'password' => bcrypt('12345678'),
           ],
           [
                'name' => 'User',
                'email' => 'user@gmail.com',
                'password' => bcrypt('12345678'),
           ],
           [
                'name' => 'Dealer',
                'email' => 'dealer@gmail.com',
                'password' => bcrypt('12345678'),
           ],

        ];
        DB::table('users')->insert($users);
    }
}
