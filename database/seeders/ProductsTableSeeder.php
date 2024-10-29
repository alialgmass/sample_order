<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory()
            ->count(10)
            ->hasColors(2)
            ->hasSizes(3)
            ->hasImages(4)
            ->create();
    }
}
