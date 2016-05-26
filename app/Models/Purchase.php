<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
	protected $fillable = [
		'product_id',
		'user_id',
		'download_id',
		'download_gardners',
		'unique_ref',
		'method',
	];

	public $timestamps  = false;
    protected $table = 'purchase';
}
