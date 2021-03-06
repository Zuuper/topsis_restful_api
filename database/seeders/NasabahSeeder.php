<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class NasabahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $id_fintechs = DB::table('tb_fintech')->pluck('id_fintech');
        $id_memberships = DB::table('tb_membership')->pluck('id_membership');
        $id_dompets = DB::table('tb_dompet')->pluck('id_dompet');

        for($i=1;$i<=10;$i++){
            DB::table('tb_nasabah')->insert([
                'id_fintech' => $faker->randomElement($id_fintechs),
                'id_membership' => $faker->randomElement($id_memberships),
                'id_dompet' => $i,
    			'nama_nasabah' => $faker->firstName,
                'nik_nasabah' => $faker->numberBetween($min = 100000, $max = 200000),
    			'alamat_nasabah' => $faker->address,
                'username_nasabah' => $faker->lastName,
                'password_nasabah' => bcrypt($faker->name),
                'no_rekening_nasabah' => $faker->numberBetween($min = 1000000, $max = 9000000),
                'pin_transaksi_nasabah' => bcrypt($faker->numberBetween($min = 100000, $max = 900000)),
    			'no_telpon_nasabah' => $faker->numberBetween($min = 100000, $max = 1000000),
                'status_nasabah' => 'aktif',
                'tanggal_aktif_nasabah' => $faker->dateTime($max = 'now', $timezone = null),
    		]);
        }

        DB::table('tb_nasabah')->insert([
            'id_fintech' => '1',
            'id_membership' => $faker->randomElement($id_memberships),
            'id_dompet' => $faker->randomElement($id_dompets),
            'nama_nasabah' => 'Michael',
            'nik_nasabah' => $faker->numberBetween($min = 100000, $max = 200000),
            'alamat_nasabah' => $faker->address,
            'username_nasabah' => 'nasabah1',
            'password_nasabah' => bcrypt('nasabah1'),
            'no_rekening_nasabah' => '12345678',
            'pin_transaksi_nasabah' => bcrypt('123456'),
            'no_telpon_nasabah' => $faker->numberBetween($min = 100000, $max = 1000000),
            'status_nasabah' => 'aktif',
            'tanggal_aktif_nasabah' => $faker->dateTime($max = 'now', $timezone = null),
        ]);
    }
}
