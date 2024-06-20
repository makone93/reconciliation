<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'f_name' => 'Master',
                'l_name' => 'User',
                'department_id' => 14,
                'user_type_id' => 1,
                'username' => 'admin',
                'password' => Hash::make('Chisc0ntr0l.')
            ],
        ]);
    }
}
