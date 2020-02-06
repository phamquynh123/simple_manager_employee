<?php

use Illuminate\Database\Seeder;

class RootAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'root',
            'email' => 'root@gmail.com',
            'password' => '$2y$10$FqxeQrM/wcHGDblgdw1tjOR1.O1FSU74Yn/02tiMx2vP71nbDDk6C', //123456
            'role_id' => '1',
        ]);
    }
}
