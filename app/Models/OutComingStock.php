<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutComingStock extends Model
{
	public $incrementing = false;

	protected $fillable = [
		'id',
		'category',
		'file_name',
		'total_row',
		'user_id',
	];

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
	
	public function details()
	{
		return $this->hasMany('App\Models\Order');
	}
}
