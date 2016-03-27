<?php

namespace App\Http\Controllers\Setting;

use Auth;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Http\Requests;
use Illuminate\Http\Request;

class MenuController extends Controller
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
		$data['head'] = $this->get_menu();
		return view('contents.settings.menu.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data['menu'] = $this->menu_access();
		$data['head'] = $this->get_menu();
		return view('contents.settings.menu.form', $data);
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

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$data['menu'] = $this->menu_access();
		$data['head'] = $this->get_menu();
		$data['item'] = Menu::find($id);
		return view('contents.settings.menu.form', $data);
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$item = Menu::find($id);
		$item->active = 'N';
		$item->updated_by = Auth::user()->name;
		$item->save();
		return redirect()->intended('/settings/menu')->with('flash-message','Data has been successfully updated !');
	}
}