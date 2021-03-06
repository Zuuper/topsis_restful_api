<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class WarungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $warung = [];
        $faker = Faker::create();
        $id_fintechs = DB::table('tb_fintech')->pluck('id_fintech');
        $id_tabungans = DB::table('tb_tabungan')->pluck('id_tabungan');

        for($i=0;$i<10;$i++){
            DB::table('tb_warung')->insert([
    			'id_fintech' => $faker->randomElement($id_fintechs),
    			'id_tabungan' => $faker->randomElement($id_tabungans),
    			'nama_pemilik' => $faker->name,
    			'nik_pemilik' => $faker->numberBetween($min = 1000000000000000, $max = 9999999999999999),
                'alamat_warung' => $faker->address,
                'nama_warung' => $faker->company,
                'username_warung' => $faker->unique()->name,
                'password_warung' => bcrypt($faker->name),
                'no_telpon_warung' => $faker->numberBetween($min = 10000000000000, $max = 99999999999999),
                'status' => $faker->randomElement(['aktif','non aktif']),
                'tanggal_aktif' => $faker->dateTime
    		]);
        }
    }
}
