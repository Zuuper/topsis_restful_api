<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class TabunganSeeder extends Seeder
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

        $id_fintechs = DB::table('tb_fintech')->pluck('id_fintech');

        for($i=0;$i<10;$i++){
            DB::table('tb_tabungan')->insert([
    			'no_rekening' => $faker->creditCardNumber,
    			'id_fintech' => $faker->randomElement($id_fintechs),
    			'saldo' => $faker->numberBetween($min = 100000, $max = 1000000),
    		]);
    }
}
}