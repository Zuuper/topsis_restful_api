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
        $id_dompets = DB::table('tb_dompet')->pluck('id_dompet');

        for($i=0;$i<10;$i++){
            DB::table('tb_warung')->insert([
    			'id_fintech' => $faker->randomElement($id_fintechs),
    			'id_dompet' => $faker->randomElement($id_dompets),
    			'nama_pemilik' => $faker->firstName,
    			'nik_pemilik' => $faker->numberBetween($min = 1000000000000000, $max = 9999999999999999),
                'alamat_warung' => $faker->streetAddress,
                'nama_warung' => $faker->company,
                'username_warung' => $faker->unique()->firstName,
                'password_warung' => bcrypt($faker->name),
                'no_rekening_warung' => $faker->numberBetween($min = 1000000, $max = 9000000),
                'no_telpon_warung' => $faker->numberBetween($min = 10000000000000, $max = 99999999999999),
                'status' => $faker->randomElement(['aktif','non aktif']),
                'tanggal_aktif' => $faker->dateTime,
    		]);
        }
    }
}
