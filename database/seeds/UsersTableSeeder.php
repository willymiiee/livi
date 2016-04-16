<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'name' => 'Admin Livi',
            'email' => 'admin@getlivi.com',
            'password' => bcrypt('getlivi'),
            'role_id' => 1,
            'active' => 'Y',
        ]);
    }
}
