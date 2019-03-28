<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
                'name' => 'Xoài cát chu',
                'description' => 'Xoài cát chu (tên khoa học là Mangifera indica) vốn là giống xoài truyền thống ở Đồng Tháp biết bao đời nay, có thể nói nó thuần chủng 100%. Xoài được nhận xét là hoa quả rất ít xơ, hương thơm nồng nàn quyến rũ, vị ngọt đầm đà. ',
                'serial' => 'CC0001'
            ],
            [
                'name' => 'Xoài cát chu 2',
                'description' => '',
                'serial' => 'CC0002'
            ],
            [
                'name' => 'Xoài cát chu 3',
                'description' => '',
                'serial' => 'CC0003'
            ],
            [
                'name' => 'Xoài cát chu 4',
                'description' => '',
                'serial' => 'CC0004'
            ],
            [
                'name' => 'Xoài cát chu 5',
                'description' => '',
                'serial' => 'CC0005'
            ],
            [
                'name' => 'Xoài cát chu 6',
                'description' => '',
                'serial' => 'CC0006'
            ],
            [
                'name' => 'Xoài cát chu 7',
                'description' => '',
                'serial' => 'CC0007'
            ],
            [
                'name' => 'Xoài cát chu 8',
                'description' => '',
                'serial' => 'CC0008'
            ],
            [
                'name' => 'Xoài cát chu 9',
                'description' => '',
                'serial' => 'CC0009'
            ]
        ]);
    }
}
