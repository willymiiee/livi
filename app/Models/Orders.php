<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
	protected $fillable = [
		'currency',
		'total',
		'purchase_date',
		'purchase_method',
		'user_id',
		'status',
		'reference',
	];
	
	public $timestamps  = false;
}
