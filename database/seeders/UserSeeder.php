<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin Heavenly',
                'email' => 'admin@heavenly.com',
                'password' => 'admin123',
                'role' => 'admin',
            ],
            [
                'name' => 'Kasir Heavenly',
                'email' => 'kasir@heavenly.com',
                'password' => 'kasir123',
                'role' => 'kasir',
            ],
            [
                'name' => 'Pelanggan Test',
                'email' => 'pelanggan@heavenly.com',
                'password' => 'pelanggan123',
                'role' => 'pelanggan',
                'phone' => '0812-3456-7890',
                'address' => 'Jl. Mawar No. 123, Bandung',
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'password' => 'password123',
                'role' => 'pelanggan',
                'phone' => '0811-1111-1111',
                'address' => 'Jl. Sudirman No. 45, Jakarta',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => 'password123',
                'role' => 'pelanggan',
                'phone' => '0812-2222-2222',
                'address' => 'Jl. Thamrin No. 67, Jakarta',
            ],
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad@example.com',
                'password' => 'password123',
                'role' => 'pelanggan',
                'phone' => '0813-3333-3333',
                'address' => 'Jl. Asia Afrika No. 89, Bandung',
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti@example.com',
                'password' => 'password123',
                'role' => 'pelanggan',
                'phone' => '0814-4444-4444',
                'address' => 'Jl. Malioboro No. 12, Yogyakarta',
            ],
            [
                'name' => 'Kasir Kedua',
                'email' => 'kasir2@heavenly.com',
                'password' => 'kasir123',
                'role' => 'kasir',
            ],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@heavenly.com',
                'password' => 'admin123',
                'role' => 'admin',
            ],
        ];

        // Safety check to prevent foreach error
        if (!is_array($users) || empty($users)) {
            throw new \Exception('Users array is null or empty in UserSeeder');
        }

        foreach ($users as $userData) {
            // Ensure userData is an array and has required fields
            if (!is_array($userData) || !isset($userData['email'], $userData['name'], $userData['password'], $userData['role'])) {
                continue; // Skip invalid user data
            }

            User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name' => $userData['name'],
                    'password' => Hash::make($userData['password']),
                    'role' => $userData['role'],
                    'phone' => $userData['phone'] ?? null,
                    'address' => $userData['address'] ?? null,
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}
