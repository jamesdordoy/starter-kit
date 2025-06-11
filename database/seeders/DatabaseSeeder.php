<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(50)->create();
        
        $this->call([
            RolePermissionSeeder::class,
        ]);

        $admin = User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'name' => 'Admin',
        ]);

        $admin->assignRole('admin');
    }
}
