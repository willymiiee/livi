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
		//
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
