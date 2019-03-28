<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ProductsTableSeeder::class);
        $this->call(FarmsTableSeeder::class);
        $this->call(ProductImagesTableSeeder::class);
        $this->call(FarmImagesTableSeeder::class);
    }
}
