<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Product;
use App\Models\User;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Product::fetchFromStripe();
        User::factory()->count(10)->create();

        $user = User::where('email', 'connorprice@hotmail.co.uk')->first();
        $staffRole = Role::where('name', 'staff')->first();

        if ($user) {
            $user->role()->associate($staffRole);
            $user->save();
        }
    }
}
