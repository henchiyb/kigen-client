<?php

use Illuminate\Database\Seeder;

class FarmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('farms')->insert([
            [
                'name' => 'Trang trại Vĩnh nông',
                'address' => 'Vĩnh Hà, Phú Xuyên',
                'description' => 'Trang trại sản xuất thực phẩm sạch'
            ],
            [
                'name' => 'Trang trại Vĩnh nông 2',
                'address' => 'Vĩnh Hà, Phú Xuyên',
                'description' => 'Trang trại sản xuất thực phẩm sạch'
            ],
            [
                'name' => 'Trang trại Vĩnh nông 3',
                'address' => 'Vĩnh Hà, Phú Xuyên',
                'description' => 'Trang trại sản xuất thực phẩm sạch'
            ],
            [
                'name' => 'Trang trại Vĩnh nông 4',
                'address' => 'Vĩnh Hà, Phú Xuyên',
                'description' => 'Trang trại sản xuất thực phẩm sạch'
            ],
            [
                'name' => 'Trang trại Vĩnh nông 5',
                'address' => 'Vĩnh Hà, Phú Xuyên',
                'description' => 'Trang trại sản xuất thực phẩm sạch'
            ],
            [
                'name' => 'Trang trại Vĩnh nông 6',
                'address' => 'Vĩnh Hà, Phú Xuyên',
                'description' => 'Trang trại sản xuất thực phẩm sạch'
            ],
            [
                'name' => 'Trang trại Vĩnh nông 7',
                'address' => 'Vĩnh Hà, Phú Xuyên',
                'description' => 'Trang trại sản xuất thực phẩm sạch'
            ],
            [
                'name' => 'Trang trại Vĩnh nông 8',
                'address' => 'Vĩnh Hà, Phú Xuyên',
                'description' => 'Trang trại sản xuất thực phẩm sạch'
            ],
            [
                'name' => 'Trang trại Vĩnh nông 9',
                'address' => 'Vĩnh Hà, Phú Xuyên',
                'description' => 'Trang trại sản xuất thực phẩm sạch'
            ],
            [
                'name' => 'Trang trại Vĩnh nông 10',
                'address' => 'Vĩnh Hà, Phú Xuyên',
                'description' => 'Trang trại sản xuất thực phẩm sạch'
            ]
        ]);
    }
}
