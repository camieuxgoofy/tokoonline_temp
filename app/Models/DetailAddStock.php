<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailAddStock extends Model
{
    public $incrementing = false;
    
	protected $fillable = [
		'id',
		'qty',
		'purchase_price',
		'add_stock_id',
		'product_id'
	];

	public function add_stock()
	{
		return $this->belongsTo('App\Models\AddStock');
	}

    public function product()
	{
		return $this->belongsTo('App\Models\Product');
	}
}
