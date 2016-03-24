<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	public function access()
	{
		return $this->hasMany('App\Models\Access');
	}
}
