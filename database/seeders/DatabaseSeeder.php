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
        $this->call(FintechSeeder::class);
        $this->call(MembershipSeeder::class);
        $this->call(NasabahSeeder::class);
        $this->call(WarungSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(DompetSeeder::class);
    }
}
