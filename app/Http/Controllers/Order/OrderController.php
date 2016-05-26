<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Book\BookController;
use App\Models\Book;
use App\Models\Orders;
use Illuminate\Http\Request;

use App\Http\Requests;

class OrderController extends Controller
{
    private $book;

    function __construct(BookController $book)
    {
        $this->book = $book;
    }

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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = $this->book->find($request->input('book_id'));
        $orderId = 0;
        if ($book):
            $orderId = Orders::create([
                            'currency'          =>  'IDR',
                            'total'             =>  0,
                            'purchase_date'     =>  date('Y-m-d'),
                            'user_id'           =>  $request->input('user_id'),
                        ])->id;
        else:
            return "Book not found";
        endif;
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
