<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Beras Putih',
                'price' => 17000,
                'stock' => 100,
                'photo' => 'uploads/products/Beras Putih.jpg'
            ],
            [
                'name' => 'Es Batu',
                'price' => 2000,
                'stock' => 200,
                'photo' => 'uploads/products/Es Batu.jpg'
            ],
            [
                'name' => 'Gula Pasir',
                'price' => 5000,
                'stock' => 150,
                'photo' => 'uploads/products/Gula Pasir.jpg'
            ],
            [
                'name' => 'Indomie Goreng',
                'price' => 3500,
                'stock' => 300,
                'photo' => 'uploads/products/Indomie Goreng.jpg'
            ],
            [
                'name' => 'Indomie Kari Ayam',
                'price' => 3500,
                'stock' => 300,
                'photo' => 'uploads/products/Indomie Kari Ayam.jpeg'
            ],
            [
                'name' => 'Minyak Kita',
                'price' => 22000,
                'stock' => 80,
                'photo' => 'uploads/products/Minyak Kita.png'
            ],
            [
                'name' => 'Rinso Sachet',
                'price' => 1000,
                'stock' => 500,
                'photo' => 'uploads/products/Rinso Sachet.png'
            ],
            [
                'name' => 'Sabun Colek Telepon',
                'price' => 3000,
                'stock' => 200,
                'photo' => 'uploads/products/Sabun Colek Telepon.jpg'
            ],
            [
                'name' => 'Sabun Telepon Batang',
                'price' => 4000,
                'stock' => 200,
                'photo' => 'uploads/products/Sabun Telepon Batang.jpeg'
            ],
            [
                'name' => 'Soklin Royale',
                'price' => 1000,
                'stock' => 400,
                'photo' => 'uploads/products/Soklin Royale.jpg'
            ],
            [
                'name' => 'Telur Ayam',
                'price' => 2500,
                'stock' => 500,
                'photo' => 'uploads/products/Telur Ayam.jpg'
            ],
            [
                'name' => 'Tepung Terigu',
                'price' => 6000,
                'stock' => 100,
                'photo' => 'uploads/products/Tepung Terigu.jpg'
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}