<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\Models\Menu;
use App\Http\Requests;
use Illuminate\Http\Request;

class SettingController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function head_menu()
	{
		// ambil head menu
		// $menus = Menu::get();
		$menus = Menu::where('parent_id', 0)
					->where('active', 'Y')
					->get();
		// sort by order
		$menus = $menus->sortBy('order')->toArray();
		return $menus;
	}

	public function menu_list()
	{
		$data['menu'] = $this->menu_access();
		$data['head'] = $this->head_menu();
		return view('contents.settings.menu.list', $data);
	}

	public function menu_add()
	{
		$data['menu'] = $this->menu_access();
		$data['head'] = $this->head_menu();
		return view('contents.settings.menu.form', $data);
	}

	public function menu_insert(Request $request)
	{
		$input = $request->all();
		$head_menu = $request->input('head_menu', '0');
		Menu::create([
			'name' => $input['name'],
			'parent_id' => $head_menu,
			'url' => $input['url'],
			'icon' => $input['icon'],
			'order' => $input['order'],
			'created_by' => Auth::user()->name,
		]);
		return redirect()->intended('/settings/menu')->with('flash-message','Data has been successfully inserted !');
	}

	public function menu_edit($id)
	{
		$data['menu'] = $this->menu_access();
		$data['head'] = $this->head_menu();
		$data['item'] = Menu::find($id);
		return view('contents.settings.menu.form', $data);
	}

	public function menu_update(Request $request)
	{
		$input = $request->all();
		$head_menu = $request->input('head_menu', '0');
		Menu::where('id', $input['id'])
			->update([
				'name' => $input['name'],
				'parent_id' => $head_menu,
				'url' => $input['url'],
				'icon' => $input['icon'],
				'order' => $input['order'],
				'updated_by' => Auth::user()->name,
			]);
		return redirect()->intended('/settings/menu')->with('flash-message','Data has been successfully updated !');
	}

	public function menu_delete($id)
	{
		$item = Menu::find($id);
		$item->active = 'N';
		$item->updated_by = Auth::user()->name;
		$item->save();
		return redirect()->intended('/settings/menu')->with('flash-message','Data has been successfully updated !');
	}
}