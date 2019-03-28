<?php

use Illuminate\Database\Seeder;

class FarmImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\FarmImage::class, 40)->create();
    }
}
