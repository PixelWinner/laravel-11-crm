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
//        TODO подумать над разрешениями
//        Permission::create(['name' => 'manage products']);
//        Permission::create(['name' => 'view orders']);
//        Permission::create(['name' => 'place orders']);
//        $adminRole->givePermissionTo(['manage products', 'view orders', 'place orders']);

        $adminRole = Role::create(['name' => User::ADMIN]);
        $sellerRole = Role::create(['name' => User::SELLER]);
        $clientRole = Role::create(['name' => User::CLIENT]);


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

        Category::factory()->count(5)->create()->each(function ($category) {
            Product::factory()->count(10)->create(['category_id' => $category->id]);
        });
    }
}
