<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        Role::factory()->create([
            'name' => 'User',
            'value' => 'USER_ROLE',
        ]);

        Role::factory()->create([
            'name' => 'Administrator',
            'value' => 'ADMIN_ROLE',
        ]);

        User::factory()->create([
            'first_name' => config('admin.first_name'),
            'last_name' => config('admin.last_name'),
            'email' => config('admin.email'),
            'password' => config('admin.password'),
        ]);

        $adminUser = User::where('email', '=', config('admin.email'))->first();
        $adminUser->roles()->attach([1, 2]);

        User::factory()->create([
            'first_name' => 'Test',
            'last_name' => 'User',
            'email' => 'test@example.com',
        ]);

        $testUser = User::where('email', '=', 'test@example.com')->first();
        $testUser->roles()->attach([1]);
    }
}
