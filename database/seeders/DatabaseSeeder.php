<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        Role::create(['name' => User::ADMIN]);
        Role::create(['name' => User::SELLER]);
        Role::create(['name' => User::CLIENT]);


        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => '11111111',
        ]);
        $admin->assignRole(User::ADMIN);

        $seller = User::factory()->create([
            'name' => 'Seller User',
            'email' => 'seller@example.com',
            'password' => '11111111',
        ]);
        $seller->assignRole(User::SELLER);

        $client = User::factory()->create([
            'name' => 'Client User',
            'email' => 'client@example.com',
            'password' => '11111111',
        ]);
        $client->assignRole(User::CLIENT);

        Category::factory()->count(2)->create()->each(function ($category) {
            Product::factory()->count(5)->create(['category_id' => $category->id]);
        });
    }
}
