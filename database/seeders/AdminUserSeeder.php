<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if the admin already exists by email
        if (!User::where('email', 'admin@ehealth.com')->exists()) {
            // Create default admin user
            User::create([
                'name' => 'Admin',
                'email' => 'admin@ehealth.com',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]);
            
            echo "Admin user created successfully!\n";
        } else {
            // Update the existing admin user
            User::where('email', 'admin@ehealth.com')->update([
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]);
            
            echo "Admin user updated successfully!\n";
        }
    }
}
