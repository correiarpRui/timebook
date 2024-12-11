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
            'date'=> Carbon::createFromFormat('d-m-Y H','1-1-2024 0'),
            'name'=> "New Year's Day"
        ]);
        DB::table('holidays')->insert(
            [
            'date'=> Carbon::createFromFormat('d-m-Y H','13-2-2024 0'),
            'name'=> "Carnival"
          ]
        );
        DB::table('holidays')->insert(
            [
            'date'=> Carbon::createFromFormat('d-m-Y H','29-3-2024 0'),
            'name'=> "Good Friday"
          ]
        );
        DB::table('holidays')->insert(
           [
            'date'=> Carbon::createFromFormat('d-m-Y H','31-3-2024 0'),
            'name'=> "Easter Sunday"
          ]
        );
        DB::table('holidays')->insert(
           [
            'date'=> Carbon::createFromFormat('d-m-Y H','25-4-2024 0'),
            'name'=> "Liberty Day"
          ]
        );
        DB::table('holidays')->insert(
           [
            'date'=> Carbon::createFromFormat('d-m-Y H','1-5-2024 0'),
            'name'=> "Labor Day"
          ]
        );
        DB::table('holidays')->insert(
           [
            'date'=> Carbon::createFromFormat('d-m-Y H','30-5-2024 0'),
            'name'=> "Corpus Christi"
          ]
        );
        DB::table('holidays')->insert(
           [
            'date'=> Carbon::createFromFormat('d-m-Y H','1-6-2024 0'),
            'name'=> "Portugal Day"
          ]
        );
        DB::table('holidays')->insert(
           [
            'date'=> Carbon::createFromFormat('d-m-Y H','15-8-2024 0'),
            'name'=> "Assumption of Mary"
          ]
        );
         DB::table('holidays')->insert(
           [
            'date'=> Carbon::createFromFormat('d-m-Y H','5-10-2024 0'),
            'name'=> "Republic Day"
          ]
        );
        DB::table('holidays')->insert(
           [
            'date'=> Carbon::createFromFormat('d-m-Y H','1-11-2024 0'),
            'name'=> "All Saints' day"
          ]
        );
        DB::table('holidays')->insert(
           [
            'date'=> Carbon::createFromFormat('d-m-Y H','1-12-2024 0'),
            'name'=> "Restoration of Independence"
          ]
        );
        DB::table('holidays')->insert(
           [
            'date'=> Carbon::createFromFormat('d-m-Y H','8-12-2024 0'),
            'name'=> "Feast of the Immaculate Conception"
          ]
        );
        DB::table('holidays')->insert(
           [
            'date'=> Carbon::createFromFormat('d-m-Y H','25-12-2024 0'),
            'name'=> "Christmas Day"
          ]
        );
    }
}