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
	public function get_category($parent_id = 0)
	{
		$cat = Category::where('active', 'Y')
					// ->orderBy('content_publishdate', 'desc')
					->where('parent_id', $parent_id)
					->get();
		return $cat->toArray();
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$data['menu'] = $this->menu_access();
		$data['category'] = array();
		$head_cat = $this->get_category();
		foreach ($head_cat as $head):
			$child = $this->get_category($head['id']);
			$head['child'] = $child;
			array_push($data['category'], $head);
		endforeach;
		return view('contents.books.categories.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data['menu'] = $this->menu_access();
		$data['head'] = $this->get_category();
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
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$data['menu'] = $this->menu_access();
		$data['head'] = $this->get_category();
		$data['item'] = Category::find($id);
		return view('contents.books.categories.form', $data);
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
		$head_cat = $request->input('head_cat', '0');
		Category::where('id', $input['id'])
			->update([
				'name' => $input['name'],
				'parent_id' => $head_cat,
				'updated_by' => Auth::user()->name,
			]);
		return redirect()->intended('/books/categories')->with('flash-message','Data has been successfully updated !');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$item = Category::find($id);
		$item->active = 'N';
		$item->updated_by = Auth::user()->name;
		$item->save();
		return redirect()->intended('/books/categories')->with('flash-message','Data has been successfully updated !');
	}
}
