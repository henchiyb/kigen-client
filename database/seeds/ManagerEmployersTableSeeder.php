<?php

use Illuminate\Database\Seeder;

class ManagerEmployersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('manager_employers')->insert([
            [
                'manager_id' => 1,
                'employer_id' => 5
            ],
            [
                'manager_id' => 1,
                'employer_id' => 6
            ],
            [
                'manager_id' => 1,
                'employer_id' => 7
            ],
            [
                'manager_id' => 2,
                'employer_id' => 8
            ],
            [
                'manager_id' => 2,
                'employer_id' => 9
            ],
            [
                'manager_id' => 3,
                'employer_id' => 10
            ]
        ]);
    }
}
