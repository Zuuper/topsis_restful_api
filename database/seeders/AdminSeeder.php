<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use DB;

class AdminSeeder extends Seeder
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

        for($i=0;$i<10;$i++){
            DB::table('tb_admin')->insert([
    			'id_fintech' => $faker->randomElement($id_fintechs),
    			'nama_admin' =>$faker->name,
                'nik_admin' => $faker->unixTime,
                'alamat_admin' => $faker->address,
                'username_admin' => $faker->company,
                'password_admin' => bcrypt($faker->name),
                'tipe_admin' => $faker->randomElement(['superadmin', 'admin']),
                'status_admin' => $faker->randomElement(['aktif', 'non aktif']),
    		]);
        }

        DB::table('tb_admin')->insert([
            'id_fintech' => 1,
    		'nama_admin' =>'admin',
            'nik_admin' => '1234567890',
            'alamat_admin' => 'jl. admin testing nomor 69',
            'username_admin' => 'admin',
            'password_admin' => bcrypt('admin'),
            'tipe_admin' => 'superadmin',
            'status_admin' => 'aktif',
        ]);
    }
}
