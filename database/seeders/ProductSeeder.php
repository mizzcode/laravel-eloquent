<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'category_id' => 'FOOD',
            'nama' => 'Whiskas',
            'description' => 'Makanan Kucing',
            'stok' => 100,
            'price' => 15000,
        ]);
        
        Product::create([
            'category_id' => 'FOOD',
            'nama' => 'Buffalo',
            'description' => 'Makanan Anjing',
            'stok' => 50,
            'price' => 25000,
        ]);
        
    }
}
