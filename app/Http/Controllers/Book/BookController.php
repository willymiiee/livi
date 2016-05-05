<?php

namespace App\Http\Controllers\Book;

use Auth;
use Validator;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests;
use Illuminate\Http\Request;

class BookController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$data['menu'] = $this->menuAccess();
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
		$input = $request->all();
		Book::create([
			'identifier' => $input['identifier'],
			'category' => $input['code'],
			'creator' => $input['creator'],
			'description' => $input['description'],
			'year' => $input['year'],
			'publisher_Id' => $input['publisher_Id'],
			'currency' => $input['currency'],
			'price' => $input['price'],
			'reseller_share' => $input['reseller_share'],
			'format' => $input['format'],
			'encryption' => $input['encryption'],
			'whitelabel' => $input['whitelabel'],
			'position' => $input['position'],
			'type' => $input['type'],
			'cover' => $input['cover'],
			'epub' => $input['epub'],
			'epub_sample' => $input['epub_sample'],
			'featured' => $input['featured'],
			'best_seller' => $input['best_seller'],
			'new' => $input['new']
		]);
		return redirect()->intended('/books/list')->with('flash-message','Data has been successfully inserted !');
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
