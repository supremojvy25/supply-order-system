<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Laptop',
            'base_price' => 1000,
            'category' => 'Electronics'
        ]);

        Product::create([
            'name' => 'Printer Paper',
            'base_price' => 20,
            'category' => 'Office'
        ]);
    }
}
