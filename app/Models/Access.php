<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
	protected $fillable = [
		'role_id', 'menu_id', 'add', 'edit', 'delete'
	];

    protected $table = 'access';
}
