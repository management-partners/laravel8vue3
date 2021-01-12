<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use DB;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = Permission::all();

        // admin role
        $admin = Role::whereName('Admin')->first();
        foreach ($permission as $per) {
            DB::table('role_permission')->insert([
                'role_id'       => $admin->id,
                'permission_id' => $per->id,
            ]);
        }
        // editor role
        $editor = Role::whereName('Editor')->first();
        foreach ($permission as $per) {
            if (!in_array($per->name, ['edit_roles'])) {
                DB::table('role_permission')->insert([
                    'role_id'       => $editor->id,
                    'permission_id' => $per->id,
                ]);
            }
        }
        // view role
        $viewer = Role::whereName('Viewer')->first();
        $viewRoles = [
            'view_users',
            'view_roles',
            'view_products',
            'view_orders',
        ];
        foreach ($permission as $per) {
            if (in_array($per->name, $viewRoles)) {
                DB::table('role_permission')->insert([
                    'role_id'       => $viewer->id,
                    'permission_id' => $per->id,
                ]);
            }
        }
    }
}
