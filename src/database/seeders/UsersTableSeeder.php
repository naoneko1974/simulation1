<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'manager',
            'email' => 'manager@shop.com',
            'password' => '00000000',
            'authority' => 1,
        ];
        DB::table('users')->insert($param);
        $param = [
            'name' => 'tencho',
            'email' => 'tencho@shop.com',
            'password' => '11111111',
            'authority' => 2,
        ];
        DB::table('users')->insert($param);
    }
}
