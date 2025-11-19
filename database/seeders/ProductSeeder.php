<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder  // ← Harus ProductSeeder, bukan StockSeeder!
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'T-Shirt Premium Cotton',
                'code' => 'TSH001',
                'price' => '150000',
                'size' => 'M',
            ],
            [
                'name' => 'T-Shirt Premium Cotton',
                'code' => 'TSH002',
                'price' => '150000',
                'size' => 'L',
            ],
            [
                'name' => 'T-Shirt Premium Cotton',
                'code' => 'TSH003',
                'price' => '150000',
                'size' => 'XL',
            ],
            [
                'name' => 'Polo Shirt Classic',
                'code' => 'PLO001',
                'price' => '200000',
                'size' => 'M',
            ],
            [
                'name' => 'Polo Shirt Classic',
                'code' => 'PLO002',
                'price' => '200000',
                'size' => 'L',
            ],
            [
                'name' => 'Polo Shirt Classic',
                'code' => 'PLO003',
                'price' => '200000',
                'size' => 'XL',
            ],
            [
                'name' => 'Hoodie Fleece Winter',
                'code' => 'HOD001',
                'price' => '350000',
                'size' => 'M',
            ],
            [
                'name' => 'Hoodie Fleece Winter',
                'code' => 'HOD002',
                'price' => '350000',
                'size' => 'L',
            ],
            [
                'name' => 'Hoodie Fleece Winter',
                'code' => 'HOD003',
                'price' => '350000',
                'size' => 'XL',
            ],
            [
                'name' => 'Jacket Denim Premium',
                'code' => 'JKT001',
                'price' => '450000',
                'size' => 'M',
            ],
            [
                'name' => 'Jacket Denim Premium',
                'code' => 'JKT002',
                'price' => '450000',
                'size' => 'L',
            ],
            [
                'name' => 'Jacket Denim Premium',
                'code' => 'JKT003',
                'price' => '450000',
                'size' => 'XL',
            ],
            [
                'name' => 'Kemeja Formal Slim Fit',
                'code' => 'KMJ001',
                'price' => '180000',
                'size' => 'M',
            ],
            [
                'name' => 'Kemeja Formal Slim Fit',
                'code' => 'KMJ002',
                'price' => '180000',
                'size' => 'L',
            ],
            [
                'name' => 'Kemeja Formal Slim Fit',
                'code' => 'KMJ003',
                'price' => '180000',
                'size' => 'XL',
            ],
            [
                'name' => 'Celana Jeans Regular',
                'code' => 'CLN001',
                'price' => '250000',
                'size' => '30',
            ],
            [
                'name' => 'Celana Jeans Regular',
                'code' => 'CLN002',
                'price' => '250000',
                'size' => '32',
            ],
            [
                'name' => 'Celana Jeans Regular',
                'code' => 'CLN003',
                'price' => '250000',
                'size' => '34',
            ],
            [
                'name' => 'Sweater Knit',
                'code' => 'SWT001',
                'price' => '275000',
                'size' => 'M',
            ],
            [
                'name' => 'Sweater Knit',
                'code' => 'SWT002',
                'price' => '275000',
                'size' => 'L',
            ],
            [
                'name' => 'Sweater Knit',
                'code' => 'SWT003',
                'price' => '275000',
                'size' => 'XL',
            ],
            [
                'name' => 'Kaos Polos Basic',
                'code' => 'KPS001',
                'price' => '85000',
                'size' => 'M',
            ],
            [
                'name' => 'Kaos Polos Basic',
                'code' => 'KPS002',
                'price' => '85000',
                'size' => 'L',
            ],
            [
                'name' => 'Kaos Polos Basic',
                'code' => 'KPS003',
                'price' => '85000',
                'size' => 'XL',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $this->command->info('Products seeded successfully!');
    }
}
