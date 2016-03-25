<?php

namespace App\Http\Controllers\Setting;

use Auth;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Http\Requests;
use Illuminate\Http\Request;

class RoleController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function role_list()
	{
		$data['menu'] = $this->menu_access();
		$data['role'] = Role::where('active', 'Y')->get();
		return view('contents.settings.role.list', $data);
	}

	public function role_add()
	{
		$data['menu'] = $this->menu_access();
		return view('contents.settings.role.form', $data);
	}

	public function role_insert(Request $request)
	{
		$input = $request->all();
		Role::create([
			'name' => $input['name'],
			'created_by' => Auth::user()->name,
		]);
		return redirect()->intended('/settings/role')->with('flash-message','Data has been successfully inserted !');
	}

	public function role_edit($id)
	{
		$data['menu'] = $this->menu_access();
		$data['item'] = Role::find($id);
		return view('contents.settings.role.form', $data);
	}

	public function role_update(Request $request)
	{
		$input = $request->all();
		Role::where('id', $input['id'])
			->update([
				'name' => $input['name'],
				'updated_by' => Auth::user()->name,
			]);
		return redirect()->intended('/settings/role')->with('flash-message','Data has been successfully updated !');
	}

	public function role_delete($id)
	{
		$item = Role::find($id);
		$item->active = 'N';
		$item->updated_by = Auth::user()->name;
		$item->save();
		return redirect()->intended('/settings/role')->with('flash-message','Data has been successfully updated !');
	}
}