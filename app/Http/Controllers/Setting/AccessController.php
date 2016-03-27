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
		$data['menu'] = $this->menu_access();
		$data['item'] = array();
		$head = $this->get_menu()->toArray();
		$i = 0;
		foreach ($head as $h):
			$access = Access::select('add', 'edit', 'delete')
						->where('role_id', $id)
						->where('menu_id', $h['id'])
						->first();
			$h['access'] = $access;

			$child_menus = array();
			$child = $this->get_menu($h['id'])->toArray();
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
	public function update(Request $request, $id)
	{
		//
	}
}
