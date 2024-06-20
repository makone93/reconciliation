<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_types')->insert([
            ['user_type' => 'Master'],
            ['user_type' => 'Admin'],
            ['user_type' => 'HOD'],
            ['user_type' => 'Manager'],
            ['user_type' => 'Supervisor'],
            ['user_type' => 'Foreman'],
            ['user_type' => 'Ordinary'],
        ]);
    }
}
