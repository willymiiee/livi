<?php

namespace App\Http\Controllers\Book;

use Auth;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
	public function get($start = 0)
	{
		$cat = Category::where('active', 'Y')
					// ->orderBy('content_publishdate', 'desc')
					->skip($start)
					->take(10)
					->get();
		return response()->json($cat);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return $this->get();
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
		return view('contents.books.categories.form', $data);
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
		$head_cat = $request->input('head_cat', '0');
		Category::create([
			'name' => $input['name'],
			'parent_id' => $head_cat,
			'created_by' => Auth::user()->name,
		]);
		return redirect()->intended('/books/categories')->with('flash-message','Data has been successfully inserted !');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
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

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		//
	}
}
