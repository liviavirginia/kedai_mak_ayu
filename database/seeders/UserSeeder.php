<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin Kedai Mak Ayu
        User::create([
            'name' => 'Admin Kedai Mak Ayu',
            'email' => 'admin@kedaimakayu.com',
            'password' => Hash::make('admin123'),
            'phone' => '082215309714',
            'address' => 'Jl. Cengkeh 5 No. 1, Medan Tuntungan',
            'role' => 'admin',
        ]);

        // Sample customers
        $customers = [
            [
                'name' => 'Livia Virginia',
                'email' => 'liviavirginia06@gmail.com',
                'phone' => '081274108647',
                'address' => 'Jl. Cengkeh 6 No. 11, Medan Tuntungan'
            ],
        ];

        foreach ($customers as $customer) {
            User::create([
                'name' => $customer['name'],
                'email' => $customer['email'],
                'password' => Hash::make('password123'),
                'phone' => $customer['phone'],
                'address' => $customer['address'],
                'role' => 'user',
            ]);
        }
    }
}