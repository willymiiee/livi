<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $fillable = [
		'name',
		'code',
		'parent_id',
		'type',
		'active',
		'created_by',
		'updated_by'
	];
}
