<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Seed Users (Admin & Cashier)
        User::factory()->create([
            "name" => "Cashier-Danny",
            "email" => "testcashier@example.com",
            "password" => bcrypt('cashier-danny-123$'),
            "role" => "cashier",
        ]);

        User::factory()->create([
            "name" => "Admin-Danny",
            "email" => "testadmin@gmail.com",
            "password" => bcrypt('admin-danny-123$'),
            "role" => "admin",
        ]);

        $this->command->info("Users seeded successfully!");

        // Seed Products
        $this->call([ProductSeeder::class, StockSeeder::class]);

        $this->command->info("All seeders completed successfully!");
    }
}
