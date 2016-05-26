<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MenusTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('menus')->insert([
			[
				'name' => 'Books',
				'parent_id' => 0,
				'url' => '#',
				'icon' => 'fa-book',
				'order' => 1,
				'active' => 'Y',
			],
			[
				'name' => 'Users',
				'parent_id' => 0,
				'url' => '/users',
				'icon' => 'fa-users',
				'order' => 2,
				'active' => 'Y',
			],
			[
				'name' => 'Report',
				'parent_id' => 0,
				'url' => '#',
				'icon' => 'fa-bar-chart',
				'order' => 3,
				'active' => 'Y',
			],
			[
				'name' => 'Settings',
				'parent_id' => 0,
				'url' => '#',
				'icon' => 'fa-cog',
				'order' => 4,
				'active' => 'Y',
			],
			[
				'name' => 'User',
				'parent_id' => 4,
				'url' => '/settings/user',
				'icon' => null,
				'order' => 1,
				'active' => 'Y',
			],
			[
				'name' => 'Role',
				'parent_id' => 4,
				'url' => '/settings/role',
				'icon' => null,
				'order' => 2,
				'active' => 'Y',
			],
			[
				'name' => 'Menu',
				'parent_id' => 4,
				'url' => '/settings/menu',
				'icon' => null,
				'order' => 3,
				'active' => 'Y',
			],
			[
				'name' => 'Categories',
				'parent_id' => 1,
				'url' => '/books/categories',
				'icon' => null,
				'order' => 2,
				'active' => 'Y',
			],
			[
				'name' => 'List',
				'parent_id' => 1,
				'url' => '/books/list',
				'icon' => null,
				'order' => 1,
				'active' => 'Y',
			],
		]);
	}
}
