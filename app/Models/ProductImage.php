<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
	use Uuids;
    use HasFactory;
    public const UPLOAD_DIR = 'uploads';

	protected $guarded = [
		'id',
		'created_at',
		'updated_at'
	];

    
	public const SMALL = '135x141';
	public const MEDIUM = '312x400';
	public const LARGE = '600x656';
	public const EXTRA_LARGE = '1125x1200';
    
	public function product()
	{
		return $this->belongsTo('App\Models\Product');
	}
}
