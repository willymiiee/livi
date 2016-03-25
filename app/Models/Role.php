<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	protected $fillable = [
		'name', 'created_by', 'updated_by'
	];

	public function access()
	{
		return $this->hasMany('App\Models\Access');
	}
}
