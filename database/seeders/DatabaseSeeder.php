<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Role;
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

        collect(RoleEnum::cases())->each(function ($roleEnum) {
            Role::firstOrCreate(['name' => $roleEnum->value]);
        });

        $admin = User::factory()->create([
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'name' => 'Admin',
        ]);

        $admin->assignRole('admin');
    }
}
