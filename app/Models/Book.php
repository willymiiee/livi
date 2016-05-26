<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	protected $fillable = [
		'identifier',
		'title',
		'category',
		'creator',
		'description',
		'language',
		'year',
		'publisher_id',
		'currency',
		'price',
		'reseller_share',
		'format',
		'encryption',
		'whitelabel',
		'position',
		'type',
		'cover',
		'epub',
		'epub_sample',
		'featured',
		'best_seller',
		'new',
		'active',
		'created_by',
		'updated_by'
	];
}
