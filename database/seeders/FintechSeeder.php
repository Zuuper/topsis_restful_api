<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class FintechSeeder extends Seeder
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
            DB::table('tb_fintech')->insert([
    			'nama' => $faker->name,
    			'alamat' => $faker->address,
    			'no_telpon' => $faker->PhoneNumber,
    			'status' => 'aktif',
    		]);
        }
    }
}
