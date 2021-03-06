<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $membership = [];
        $faker = Faker::create();

        $id_fintechs = DB::table('tb_fintech')->pluck('id_fintech');

        for($i=0;$i<10;$i++){
            DB::table('tb_membership')->insert([
    			'id_fintech' => $faker->randomElement($id_fintechs),
    			'kategori' => $faker->randomElement(['gold', 'silver','bronze']),
    			'limit' => $faker->numberBetween($min = 1500, $max = 6000),
    		]);
        }
    }
}
