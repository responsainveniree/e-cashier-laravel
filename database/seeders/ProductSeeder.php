<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'T-Shirt Premium Cotton',
                'price' => 150000,
                'size' => 'medium',
                'quantity' => 50,
                'description' => 'T-Shirt berbahan cotton premium, nyaman dipakai sehari-hari.',
            ],
            [
                'name' => 'T-Shirt Premium Cotton',
                'price' => 150000,
                'size' => 'large',
                'quantity' => 50,
                'description' => 'T-Shirt berbahan cotton premium, nyaman dipakai sehari-hari.',
            ],
            [
                'name' => 'T-Shirt Premium Cotton',
                'price' => 150000,
                'size' => 'large',
                'quantity' => 50,
                'description' => 'T-Shirt berbahan cotton premium, nyaman dipakai sehari-hari.',
            ],
            [
                'name' => 'Polo Shirt Classic',
                'price' => 200000,
                'size' => 'large',
                'quantity' => 40,
                'description' => 'Polo shirt model klasik dengan bahan adem.',
            ],
            [
                'name' => 'Polo Shirt Classic',
                'price' => 200000,
                'size' => 'large',
                'quantity' => 40,
                'description' => 'Polo shirt model klasik dengan bahan adem.',
            ],
            [
                'name' => 'Polo Shirt Classic',
                'price' => 200000,
                'size' => 'medium',
                'quantity' => 40,
                'description' => 'Polo shirt model klasik dengan bahan adem.',
            ],
            [
                'name' => 'Hoodie Fleece Winter',
                'price' => 350000,
                'size' => 'medium',
                'quantity' => 30,
                'description' => 'Hoodie fleece hangat cocok untuk cuaca dingin.',
            ],
            [
                'name' => 'Hoodie Fleece Winter',
                'price' => 350000,
                'size' => 'small',
                'quantity' => 30,
                'description' => 'Hoodie fleece hangat cocok untuk cuaca dingin.',
            ],
            [
                'name' => 'Hoodie Fleece Winter',
                'price' => 350000,
                'size' => 'small',
                'quantity' => 30,
                'description' => 'Hoodie fleece hangat cocok untuk cuaca dingin.',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('Products seeded successfully!');
    }
}
