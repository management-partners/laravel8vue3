<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RolesSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\GallerySeeder;

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
            CategorySeeder::class,
            GallerySeeder::class,
            // PermissionSeeder::class,
            // RolePermissionSeeder::class,
            UserSeeder::class,

            ProductSeeder::class,
            // OrderSeeder::class
        ]);
    }
}
