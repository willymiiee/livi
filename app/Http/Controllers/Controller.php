<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Menu;
use App\Models\Role;
use App\Models\Category;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	protected function menu_access()
	{
		$role = Role::find(Auth::user()->role_id);
		$menus = array();

		// list menu apa saja yg bisa diakses seorang user
		foreach ($role->access as $ak):
			$menu = Menu::find($ak->menu_id);
			if ($menu->active == 'Y'):
				$menu = $menu->toArray();
				$menu['add'] = $ak->add;
				$menu['edit'] = $ak->edit;
				$menu['delete'] = $ak->delete;
				array_push($menus, $menu);
			endif;
		endforeach;
		
		// ambil head menu (yang parent id nya 0) dari list menu
		$data = array_where($menus, function ($key, $value) {
			if ($value['parent_id'] == 0):
				return $value;
			endif;
		});

		// sort head menu by order
		// $data = array_sort($data, function ($key, $value) {
			// return $value['order'];
		// });
		
		// tiap head menu
		foreach ($data as $k => $v):
			$data[$k]['child'] = array();
			// tiap list menu
			foreach ($menus as $m):
				// dicari yg parent id nya dari list menu cocok sama id dari head menu
				if ($m['parent_id'] == $v['id']):
					array_push($data[$k]['child'], $m);
				endif;
			endforeach;
		endforeach;

		return $data;
	}

	public function get_menu($head_id = 0)
	{
		// ambil menu
		$menus = Menu::where('parent_id', $head_id)
					->where('active', 'Y')
					->get();
		// sort by order
		$menus = $menus->sortBy('order');
		return $menus;
	}
}
