<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SuperadminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'first_name' => 'Tom',
            'last_name'=> 'Cromwell',
            'email' => 'tom@world.com',
            'birth_date'=> '1995-1-1',
            'password' => Hash::make('password'),
            'vacation_days'=>22,
            'vacation_days_left' => 22,
            'role_id'=>3
        ], 
        );
    }
}
