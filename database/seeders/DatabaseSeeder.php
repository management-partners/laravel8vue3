<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RolesSeeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesSeeder::class,
            // PermissionSeeder::class,
            // RolePermissionSeeder::class,
            // UserSeeder::class,
            // ProductSeeder::class,
            // OrderSeeder::class
        ]);
        User::factory(10000)->create();
    }
}
