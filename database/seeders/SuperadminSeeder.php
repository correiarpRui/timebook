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
            'first_name' => 'admin',
            'last_name'=> 'test',
            'email' => 'admin@world.com',
            'birth_date'=> '1995-1-1',
            'password' => Hash::make('password'),
            'role_id'=>3
        ], 
        );
    }
}
