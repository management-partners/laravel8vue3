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
                'name' => 'admin',
                'description' => 'System managerment',
                'created_at' =>  Carbon::now()
            ],
            [
                'name' => 'editor',
                'description' => 'System post managerment',
                'created_at' =>  Carbon::now()
            ],
            [
                'name' => 'user',
                'description' => 'Normal user in system',
                'created_at' =>  Carbon::now()
            ],
        ]
        );
    }
}
