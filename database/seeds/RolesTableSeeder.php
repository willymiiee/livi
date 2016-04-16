<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
        	[
	            'name' => 'Administrator',
	            'active' => 'Y',
        	],
        	[
	            'name' => 'Publisher',
	            'active' => 'Y',
        	],
        ]);
    }
}
