<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory(100)->create()->each(function ($product) {
            $product->categories()->sync(
                Arr::random(range(1, 40), random_int(1, 4))
            );
        });
    }
}
