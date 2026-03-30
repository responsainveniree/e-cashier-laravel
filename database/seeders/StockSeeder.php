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
        $admin = User::where("role", "admin")->first();

        if (!$admin) {
            $this->command->error(
                "Admin user not found! Please run UserSeeder first.",
            );
            return;
        }

        // Ambil semua products
        $products = Product::all();

        if ($products->isEmpty()) {
            $this->command->error(
                "No products found! Please run ProductSeeder first.",
            );
            return;
        }

        foreach ($products as $product) {
            Stock::create([
                "product_id" => $product->id,
                "quantity" => rand(5, 50),
                "status" => "IN_STOCK",
                "created_by" => $admin->name,
            ]);
        }

        $this->command->info("Stocks seeded successfully!");
    }
}
