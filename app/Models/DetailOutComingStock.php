<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailOutComingStock extends Model
{
    public $incrementing = false;
    
	protected $fillable = [
		'id',
		'qty',
		'price',
		'out_coming_stock_id',
		'product_id'
	];

	public function out_cming_stock()
	{
		return $this->belongsTo('App\Models\OutComingStock');
	}

    public function product()
	{
		return $this->belongsTo('App\Models\Product');
	}
}
