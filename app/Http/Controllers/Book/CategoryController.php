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
	public function all($start = 0)
	{
		$cat = Category::where('active', 'Y')
					// ->orderBy('content_publishdate', 'desc')
					// ->skip($start)
					// ->take(15)
					->get();
		return $cat->toArray();
	}

	public function getSingle($id)
	{
		$cat = Category::where('id', $id)
					->first();
		return $cat->toArray();
	}

	public function find(Request $request, $start = 0)
	{
		if ($request->has('kategori')):
			$kategori = $request->input('kategori');
			$request->session()->put('kategori', $kategori);
		else:
			$kategori = $request->session()->get('kategori');
		endif;
		$cat = Category::where('active', 'Y')
					->where('name', 'like', '%'.$kategori.'%')
					// ->orderBy('content_publishdate', 'desc')
					->skip($start)
					->take(15)
					->get();
		return response()->json($cat);
	}

	public function getCategory($parent_id = 0, $skip = 0)
	{
		$cat = Category::where('active', 'Y')
					->where('parent_id', $parent_id)
					->skip(($skip - 1) * 15)
					->take(1000)
					->get();
		return $cat->toArray();
	}

	public function getByCode($code)
	{
		$cat = Category::where('active', 'Y')
					->where('code', $code)
					->first();
		return $cat;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$page = $request->input('page');
		$data['menu'] = $this->menuAccess();
		$data['category'] = $this->getCategory(0, $page);
		$i = 0;
		foreach ($data['category'] as $head):
			$child = $this->getCategory($head['id']);
			$data['category'][$i]['child'] = $child;
			$i++;
		endforeach;
		$data['category'] = new \Illuminate\Pagination\Paginator($data['category'], 15, $page);
		$data['category']->setPath('categories');
		return view('contents.books.categories.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data['menu'] = $this->menuAccess();
		$data['head'] = $this->getCategory();
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
			'code' => $input['code'],
			'parent_id' => $head_cat,
			'type' => $input['type'],
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
		$data['menu'] = $this->menuAccess();
		$data['head'] = $this->getCategory();
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
				'code' => $input['code'],
				'parent_id' => $head_cat,
				'type' => $input['type'],
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
