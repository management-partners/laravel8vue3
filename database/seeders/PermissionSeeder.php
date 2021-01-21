<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['name' => 'view_users'],
            ['name' => 'edit_users'],
            ['name' => 'del_users'],
            ['name' => 'view_roles'],
            ['name' => 'edit_roles'],
            ['name' => 'del_roles'],
            ['name' => 'view_products'],
            ['name' => 'edit_products'],
            ['name' => 'del_products'],
            ['name' => 'view_orders'],
            ['name' => 'del_orders'],
        ]);
    }
}
