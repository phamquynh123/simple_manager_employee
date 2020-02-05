<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'root',
            'display_name' => 'Root',
            'description' => 'Root',
        ]);
        DB::table('roles')->insert([
            'name' => 'manager',
            'display_name' => 'Trưởng Phòng',
            'description' => 'Manager',
        ]);
        DB::table('roles')->insert([
            'name' => 'employee',
            'display_name' => 'Nhân Viên',
            'description' => 'Nhân Viên',
        ]);
    }
}
