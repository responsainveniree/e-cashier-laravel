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

        User::factory()->create([
            'name' => 'Cashier-Danny',
            'email' => 'testcashier@example.com',
            'password' => bcrypt('cashier-danny-123$'),
            'role' => 'cashier'
        ]);

        User::factory()->create([
            'name' => 'Admin-Danny',
            'email' => 'testadmin@gmail.com',
            'password' => bcrypt('admin-danny-123$'),
            'role' => 'admin'
        ]);
    }
}
