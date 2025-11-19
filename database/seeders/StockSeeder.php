<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Database\Seeder;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil admin user untuk created_by
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            $this->command->error('Admin user not found! Please run UserSeeder first.');
            return;
        }

        // Ambil semua products
        $products = Product::all();

        if ($products->isEmpty()) {
            $this->command->error('No products found! Please run ProductSeeder first.');
            return;
        }

        // Status yang tersedia
        $statuses = ['available', 'reserved', 'sold'];

        foreach ($products as $product) {
            // Setiap product akan punya 2-4 stock records dengan status berbeda
            $stockCount = rand(2, 4);

            for ($i = 0; $i < $stockCount; $i++) {
                Stock::create([
                    'product_id' => $product->id,
                    'quantity' => rand(5, 50), // Random quantity antara 5-50
                    'status' => $statuses[array_rand($statuses)], // Random status
                    'created_by' => $admin->name,
                ]);
            }
        }

        $this->command->info('Stocks seeded successfully!');
    }
}
