<?php

use Illuminate\Database\Seeder;

class AccessTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('access')->insert([
			[
				'role_id' => '1',
				'menu_id' => '1',
				'add' => 'Y',
				'edit' => 'Y',
				'delete' => 'Y',
			],
			[
				'role_id' => '1',
				'menu_id' => '2',
				'add' => 'Y',
				'edit' => 'Y',
				'delete' => 'Y',
			],
			[
				'role_id' => '1',
				'menu_id' => '3',
				'add' => 'Y',
				'edit' => 'Y',
				'delete' => 'Y',
			],
			[
				'role_id' => '1',
				'menu_id' => '4',
				'add' => 'Y',
				'edit' => 'Y',
				'delete' => 'Y',
			],
			[
				'role_id' => '1',
				'menu_id' => '5',
				'add' => 'Y',
				'edit' => 'Y',
				'delete' => 'Y',
			],
			[
				'role_id' => '1',
				'menu_id' => '6',
				'add' => 'Y',
				'edit' => 'Y',
				'delete' => 'Y',
			],
			[
				'role_id' => '1',
				'menu_id' => '7',
				'add' => 'Y',
				'edit' => 'Y',
				'delete' => 'Y',
			],
			[
				'role_id' => '1',
				'menu_id' => '8',
				'add' => 'Y',
				'edit' => 'Y',
				'delete' => 'Y',
			],
			[
				'role_id' => '1',
				'menu_id' => '9',
				'add' => 'Y',
				'edit' => 'Y',
				'delete' => 'Y',
			],
		]);
	}
}
