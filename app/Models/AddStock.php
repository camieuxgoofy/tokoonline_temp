<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddStock extends Model
{
	public $incrementing = false;

	protected $fillable = [
		'id',
		'date',
		'supplier_id',
		'user_id',
	];

	public function supplier()
	{
		return $this->belongsTo('App\Models\Supplier');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}

	public function details()
	{
		return $this->hasMany('App\Models\DetailAddStock');
	}
}
