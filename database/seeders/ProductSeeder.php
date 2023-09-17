<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'name' => 'B2C Product',
            'category' => 'b2c',
            'price' => 80,
            'stripe_price_id' => 'price_1NrHssDj7UxwcjIVtSaoQ6VG'
        ]);

        Product::create([
            'name' => 'B2B Product',
            'category' => 'b2b',
            'price' => 100,
            'stripe_price_id' => 'price_1NrHkIDj7UxwcjIV2VwBgYFy'
        ]);
    }
}
