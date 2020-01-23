<?php

use App\Models\Service\Category;
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: devert
 * Date: 1/23/20
 * Time: 7:25 PM
 */

class CategoryTableSeeder extends Seeder
{
    public function run()
    {
        Category::create([
            'name' => 'Mobile Money',
            'code' => '123456',
            'is_active' => true,
        ]);
    }
}
