<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Db::table("users")->insert([
            "name" => "Dương Văn Huấn",
            "email" => "huandvph43667@fpt.edu.vn",
            "age" => 21,
            "department_id" => 1,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);
    }
}
