<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HolidaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        DB::table('holidays')->insert([
            'name'=> "New Year's Day",
            'day'=> "1",
            'month'=> "1"
        ]);
        DB::table('holidays')->insert(
           [
            'name'=> "Liberty Day",
            'day'=> "25",
            'month'=> "4"
          ]
        );
        DB::table('holidays')->insert(
           [
            'name'=> "Labor Day",
            'day'=> "1",
            'month'=> "5"
          ]
        );
        DB::table('holidays')->insert(
           [
            'name'=> "Portugal Day",
            'day'=> "10",
            'month'=> "6"
          ]
        );
        DB::table('holidays')->insert(
           [
            'name'=> "Assumption of Mary",
            'day'=> "15",
            'month'=> "8"
          ]
        );
         DB::table('holidays')->insert(
           [
            'name'=> "Republic Day",
            'day'=> "5",
            'month'=> "10"
          ]
        );
        DB::table('holidays')->insert(
           [
            'name'=> "All Saints' day",
            'day'=> "1",
            'month'=> "11"
          ]
        );
        DB::table('holidays')->insert(
           [
            'name'=> "Restoration of Independence",
            'day'=> "1",
            'month'=> "12"
          ]
        );
        DB::table('holidays')->insert(
           [
            'name'=> "Immaculate Conception",
            'day'=> "8",
            'month'=> "12"
          ]
        );
        DB::table('holidays')->insert(
           [
            'name'=> "Christmas Day",
            'day'=> "25",
            'month'=> "12"
          ]
        );
    }
}