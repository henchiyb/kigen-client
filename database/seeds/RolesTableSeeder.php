<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'role' => 'ROLE_MANAGER'
            ],
            [
                'role' => 'ROLE_MAIN_MANAGER'
            ],
            [
                'role' => 'ROLE_FARM_MANAGER'
            ],
            [
                'role' => 'ROLE_TRANSPORTATION_MANAGER'
            ],
            [
                'role' => 'ROLE_STORE_MANAGER'
            ],
            [
                'role' => 'ROLE_FARMER'
            ],
            [
                'role' => 'ROLE_TRANSPORTATION_EMPLOYER'
            ],
            [
                'role' => 'ROLE_STORE_EMPLOYER'
            ],
            [
                'role' => 'GUEST'
            ],
            [
                'role' => 'SUPPORT'
            ]
        ]);
    }
}
