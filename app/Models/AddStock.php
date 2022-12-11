<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddStock extends Model
{
	protected $fillable = [
		'date',
		'qty',
		'purchase_price',
		'supplier_id',
		'product_id',
		'user_id',
	];

	public function supplier()
	{
		return $this->belongsTo('App\Models\Supplier');
	}

	public function product()
	{
		return $this->belongsTo('App\Models\Product');
	}

	public function user()
	{
		return $this->belongsTo('App\Models\User');
	}
}
