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

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data['menu'] = $this->menu_access();
		$data['role'] = Role::where('active', 'Y')->get();
		// $coba = array_where($data['menu'], function($k, $v) {
		// 	if ($v['name'] == Request::segment(2)):
		// 		return $v;
		// 	endif;
		// });
		// print_r($coba); die();
		return view('contents.settings.role.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data['menu'] = $this->menu_access();
		return view('contents.settings.role.form', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$input = $request->all();
		Role::create([
			'name' => $input['name'],
			'created_by' => Auth::user()->name,
		]);
		return redirect()->intended('/settings/role')->with('flash-message','Data has been successfully inserted !');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$data['menu'] = $this->menu_access();
		$data['item'] = Role::find($id);
		return view('contents.settings.role.form', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$input = $request->all();
		Role::where('id', $input['id'])
			->update([
				'name' => $input['name'],
				'updated_by' => Auth::user()->name,
			]);
		return redirect()->intended('/settings/role')->with('flash-message','Data has been successfully updated !');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$item = Role::find($id);
		$item->active = 'N';
		$item->updated_by = Auth::user()->name;
		$item->save();
		return redirect()->intended('/settings/role')->with('flash-message','Data has been successfully updated !');
	}
}