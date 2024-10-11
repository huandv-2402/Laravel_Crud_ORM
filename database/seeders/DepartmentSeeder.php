<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("departments")->insert([
            "name" => "Phòng IT",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("departments")->insert([
            "name" => "Phòng Sales",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("departments")->insert([
            "name" => "Phòng Marketing",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("departments")->insert([
            "name" => "Phòng Kế Toán",
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);
    }
}
