<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workUnitId = DB::table('work_units')->insertGetId([
            'work_unit_name' => 'Jakarta 2A',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $religionId = DB::table('religions')->insertGetId([
            'religion_name' => 'Islam',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $workPlaceId = DB::table('work_places')->insertGetId([
            'work_place_name' => 'Jakarta',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $positionId = DB::table('positions')->insertGetId([
            'position_description' => 'Kepala Sekretariat Utama',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $echelonId = DB::table('echelons')->insertGetId([
            'echelon_name' => 'I',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $rankId = DB::table('ranks')->insertGetId([
            'rank_name' => 'IV/a',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('employees')->insert([
            'employee_id' => '12130569001',
            'name' => 'Saifulloh Rifai',
            'birth_place' => 'Banjarnegara',
            'address' => 'Jl. Melon No.16 Dian Asri',
            'birth_date' => now()->toDateString(),
            'gender' => 'male',
            'rank_id' => $rankId,
            'echelon_id' => $echelonId,
            'position_id' => $positionId,
            'work_place_id' => $workPlaceId,
            'religion_id' => $religionId,
            'work_unit_id' => $workUnitId,
            'phone_number' => '087775555',
            'npwp_number' => '233333333',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
