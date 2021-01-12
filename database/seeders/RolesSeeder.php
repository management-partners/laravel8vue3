<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
            [
                'name' => 'Admin',
                'description' => 'System managerment',
                'created_at' =>  Carbon::now()
            ],
            [
                'name' => 'Editor',
                'description' => 'System post managerment',
                'created_at' =>  Carbon::now()
            ],
            [
                'name' => 'Viewer',
                'description' => 'Normal user in system',
                'created_at' =>  Carbon::now()
            ],
        ]
        );
    }
}
