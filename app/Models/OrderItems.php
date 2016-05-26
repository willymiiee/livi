<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
	protected $fillable = [
		'order_id',
		'product_id',
		'price',
	];
	
	public $timestamps  = false;
}
