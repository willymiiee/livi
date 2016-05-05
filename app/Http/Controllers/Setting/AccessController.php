<?php

namespace App\Http\Controllers\Setting;

use Auth;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\Access;
use App\Http\Requests;
use Illuminate\Http\Request;

class AccessController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$data['menu'] = $this->menuAccess();
		$data['item'] = array();
		$head = $this->getMenu()->toArray();
		$i = 0;
		foreach ($head as $h):
			$access = Access::select('add', 'edit', 'delete')
						->where('role_id', $id)
						->where('menu_id', $h['id'])
						->first();
			$h['access'] = $access;

			$child_menus = array();
			$child = $this->getMenu($h['id'])->toArray();
			foreach ($child as $c):
				$access = Access::select('add', 'edit', 'delete')
							->where('role_id', $id)
							->where('menu_id', $c['id'])
							->first();
				$c['access'] = $access;
				array_push($child_menus, $c);
			endforeach;
			$h['child'] = $child_menus;
			array_push($data['item'], $h);
			$i++;
		endforeach;
		return view('contents.settings.access.form', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$input = $request->all();
		Access::where('role_id', $input['roleId'])
			->delete();
		foreach ($input['menu'] as $menuId => $val):
			(array_key_exists($menuId, $input['add']) ? $add = 'Y' : $add = 'N');
			(array_key_exists($menuId, $input['edit']) ? $edit = 'Y' : $edit = 'N');
			(array_key_exists($menuId, $input['delete']) ? $delete = 'Y' : $delete = 'N');
			Access::create([
				'role_id' => $input['roleId'],
				'menu_id' => $menuId,
				'add' => $add,
				'edit' => $edit,
				'delete' => $delete
			]);
		endforeach;
		return redirect()->intended('/settings/role')->with('flash-message','Data has been successfully updated !');
	}
}
