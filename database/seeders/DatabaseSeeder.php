<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'full_name' => 'System Administrator',
                'password' => 'password',
                'avatar' => null,
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Sample Product'],
            [
                'price' => 100.00,
                'stock_quantity' => 50,
                'image' => null,
            ]
        );

        Product::updateOrCreate(
            ['name' => 'Another Product'],
            [
                'price' => 150.00,
                'stock_quantity' => 25,
                'image' => null,
            ]
        );

        Customer::updateOrCreate(
            ['email' => 'customer@example.com'],
            [
                'full_name' => 'Sample Customer',
                'phone' => '09123456789',
            ]
        );
    }
}