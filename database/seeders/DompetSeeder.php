<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class DompetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fintech = [];
        $faker = Faker::create();

        for($i=0;$i<10;$i++){
            DB::table('tb_dompet')->insert([
                'saldo_nasabah' => $faker->numberBetween($min = 100000, $max = 1000000),
    		]);
        }
    }
}
