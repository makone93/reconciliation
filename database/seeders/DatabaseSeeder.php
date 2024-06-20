<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTypeSeeder::class);
        $this->call(AccessRightSeeder::class);
        $this->call(AccessPermissionSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(SiteSeeder::class);
        $this->call(UserSeeder::class);
        // temp seeders
        // $this->call(VehicleSeeder::class);
        // $this->call(DriverSeeder::class);
    }
}
