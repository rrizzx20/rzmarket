<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks
        \Illuminate\Support\Facades\Schema::disableForeignKeyConstraints();

        // Clean existing data
        Product::truncate();
        Category::truncate();

        \Illuminate\Support\Facades\Schema::enableForeignKeyConstraints();

        $category = Category::create([
            'name' => 'Rokok',
            'slug' => 'rokok'
        ]);

        $products = [
            [
                'name' => 'Surya 12',
                'category_id' => $category->id,
                'buy_price' => 20000,
                'sell_price' => 22000,
                'price_per_stick' => 2000,
                'commission' => 2000,
                'stock' => 0,
            ],
            [
                'name' => 'Surya 16',
                'category_id' => $category->id,
                'buy_price' => 28000,
                'sell_price' => 30000,
                'price_per_stick' => 2000,
                'commission' => 2000,
                'stock' => 0,
            ],
            [
                'name' => 'Surya Kaleng',
                'category_id' => $category->id,
                'buy_price' => 60000,
                'sell_price' => 65000,
                'price_per_stick' => 3000,
                'commission' => 5000,
                'stock' => 0,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
