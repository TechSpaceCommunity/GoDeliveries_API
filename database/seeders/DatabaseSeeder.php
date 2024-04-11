<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Create a user with specific attributes
        $user = new User();
        $user->name = 'silvo';
        $user->email = 'silvans@gmail.com';
        $user->password = Hash::make('admin123'); 
        $user->save();
    }
}
