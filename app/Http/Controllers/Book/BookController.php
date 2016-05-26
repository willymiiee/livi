<?php

namespace App\Http\Controllers\Book;

use Auth;
use Validator;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Book\CategoryController;
use App\Models\Book;
use App\Http\Requests;
use Illuminate\Http\Request;

class BookController extends Controller
{
	private $category;

	function __construct(CategoryController $category)
	{
		$this->category = $category;
	}

	public function getBook($skip = 1)
	{
		$request = app(Request::class);
		$b = Book::skip(($skip - 1) * 15)
					->where('active', 'Y')
					->when($request->input('type') == 'title', function ($query) use ($request) {
						return $query->where('title', 'like', '%'.$request->input('param').'%');
					})
					->when($request->input('type') == 'author', function ($query) use ($request) {
						return $query->where('creator', 'like', '%'.$request->input('param').'%');
					})
					->when($request->input('free'), function ($query) {
						return $query->where('price', 0);
					})
					->when($request->input('best_seller'), function ($query) {
						return $query->where('best_seller', 'Y');
					})
					->when($request->input('new'), function ($query) {
						return $query->where('new', 'Y');
					})
					->when($request->input('language'), function ($query) use ($request) {
						return $query->where('language', 'like', '%'.$request->input('language').'%');
					})
					->orderBy('created_at', 'desc')
					->take(15)
						// return $query->paginate();
					->get();

		$b = $this->assignCategory($b);

		return $b;
	}

	public function paginateBook($skip = 1)
	{
		$b = Book::skip(($skip - 1) * 15)
					->where('active', 'Y')
					->orderBy('created_at', 'desc')
					->take(15)
					->paginate();

		$b = $this->assignCategory($b);

		return $b;
	}

	public function assignCategory($books)
	{
		$allCategory = $this->category->all();
		$i = 0;
		foreach ($books as $book):
			$cat = explode(',', $book['category']);
			$j = 0;
			foreach ($cat as $c):
				if ($c != ""):
					foreach ($allCategory as $all):
						if ($c == $all['code']):
							$cat[$j] = $all['name'];
							break;
						endif;
					endforeach;
					$j++;
				endif;
			endforeach;
			$books[$i]['category'] = $cat;
			$i++;
		endforeach;

		return $books;
	}

	public function find($id)
	{
		$item = Book::where('id', $id)
					->first();
		if ($item):
			return $item->toArray();
		endif;
		return false;
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
		$data['books'] = $this->paginateBook();

		return view('contents.books.books.list', $data);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data['menu'] = $this->menuAccess();
		$data['category'] = $this->category->all();
		return view('contents.books.books.form', $data);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$path = base_path() . '/public/uploads/';
		$input = $request->all();
		$categories = $request->input('category');
		$categoryCode = "";
		$separator = ",";

		foreach ($categories as $key => $value):
			$cat = $this->category->getSingle($value);
			if ($key == sizeof($categories) - 1):
				$separator = "";
			endif;
			$cat['code'] != null ? $categoryCode .= $cat['code'] . $separator : '';
		endforeach;

		$input['category'] = $categoryCode;

		if ($request->hasFile('epub')):
			$filename = $request->file('epub')->getClientOriginalName();
			$request->file('epub')->move($path.'books/', $filename);
			$input['epub'] = $path.'books/'.$filename;
		endif;

		if ($request->hasFile('epubSample')):
			$filename = $request->file('epubSample')->getClientOriginalName();
			$request->file('epubSample')->move($path.'samples/', $filename);
			$input['epub_sample'] = $path.'samples/'.$filename;
		endif;

		if ($request->hasFile('cover')):
			$filename = $request->file('cover')->getClientOriginalName();
			$request->file('cover')->move($path.'covers/', $filename);
			$input['cover'] = $path.'covers/'.$filename;
		endif;

		// dump($input); exit();
		Book::create([
			'identifier' => $input['identifier'],
			'title' => $input['title'],
			'category' => $input['category'],
			'creator' => $input['creator'],
			'description' => $input['description'],
			'language' => $input['language'],
			'year' => $input['year'],
			'publisher_Id' => $input['publisher'],
			'currency' => $input['currency'],
			'price' => $input['price'],
			'reseller_share' => $input['resellerShare'],
			'format' => $input['format'],
			'encryption' => $input['encryption'],
			'whitelabel' => $input['whitelabel'],
			'type' => $input['type'],
			'cover' => isset($input['cover']) ? $input['cover'] : null,
			'epub' => isset($input['epub']) ? $input['epub'] : null,
			'epub_sample' => isset($input['epub_sample']) ? $input['epub_sample'] : null,
			'featured' => isset($input['featured']) ? 'Y' : 'N',
			'best_seller' => isset($input['bestSeller']) ? 'Y' : 'N',
			'new' => isset($input['newRelease']) ? 'Y' : 'N'
		]);
		return redirect()->intended('/books/list')->with('flash-message','Data has been successfully inserted !');
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
		$data['category'] = $this->category->all();
		$data['item'] = Book::find($id);
		$itemCategories = explode(',', $data['item']->category);
		$data['item']->category = "";
		$separator = ",";
		foreach ($itemCategories as $key => $item):
			if ($item != ""):
				$cat = $this->category->getByCode($item);
				if ($key == sizeof($itemCategories) - 1):
					$separator = "";
				endif;
				$data['item']->category .= $cat->id . $separator;
			endif;
		endforeach;
		return view('contents.books.books.form', $data);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request)
	{
		$path = base_path() . '/public/uploads/';
		$input = $request->all();
		$item = Book::find($input['id']);

		$categories = $request->input('category');
		$categoryCode = "";
		$separator = ",";

		foreach ($categories as $key => $value):
			$cat = $this->category->getSingle($value);
			if ($key == sizeof($categories) - 1) {
				$separator = "";
			}
			$cat['code'] != null ? $categoryCode .= $cat['code'] . $separator : '';
		endforeach;

		$input['category'] = $categoryCode;

		if ($request->hasFile('epub')):
			$filename = $request->file('epub')->getClientOriginalName();
			$request->file('epub')->move($path.'books/', $filename);
			$input['epub'] = $path.'books/'.$filename;
		endif;

		if ($request->hasFile('epubSample')):
			$filename = $request->file('epubSample')->getClientOriginalName();
			$request->file('epubSample')->move($path.'samples/', $filename);
			$input['epub_sample'] = $path.'samples/'.$filename;
		endif;

		if ($request->hasFile('cover')):
			$filename = $request->file('cover')->getClientOriginalName();
			$request->file('cover')->move($path.'covers/', $filename);
			$input['cover'] = $path.'covers/'.$filename;
		endif;
		// dump($input); exit();
		Book::where('id', $input['id'])
			->update([
				'identifier' => $input['identifier'],
				'title' => $input['title'],
				'category' => $input['category'],
				'creator' => $input['creator'],
				'description' => $input['description'],
				'language' => $input['language'],
				'year' => $input['year'],
				'publisher_Id' => $input['publisher'],
				'currency' => $input['currency'],
				'price' => $input['price'],
				'reseller_share' => $input['resellerShare'],
				'format' => $input['format'],
				'encryption' => $input['encryption'],
				'whitelabel' => $input['whitelabel'],
				'type' => $input['type'],
				'cover' => isset($input['cover']) ? $input['cover'] : $item['cover'],
				'epub' => isset($input['epub']) ? $input['epub'] : $item['epub'],
				'epub_sample' => isset($input['epub_sample']) ? $input['epub_sample'] : $item['epub_sample'],
				'featured' => isset($input['featured']) ? 'Y' : 'N',
				'best_seller' => isset($input['bestSeller']) ? 'Y' : 'N',
				'new' => isset($input['newRelease']) ? 'Y' : 'N'
				// 'updated_by' => Auth::user()->name,
		]);
		return redirect()->intended('/books/list')->with('flash-message','Data has been successfully updated !');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		Book::where('id', $id)
			->update([
				'active' => 'N',
		]);
		return redirect()->intended('/books/list')->with('flash-message','Data has been successfully deleted !');
	}
}
