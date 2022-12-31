<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
	use Uuids;
    use HasFactory;
    public const PENDING = 'pending';
	public const SHIPPED = 'shipped';

	protected $fillable = [
		'user_id',
		'order_id',
		'track_number',
		'status',
		'total_qty',
		'total_weight',
		'first_name',
		'last_name',
		'address1',
		'address2',
		'phone',
		'email',
		'city_id',
		'province_id',
		'postcode',
		'shipped_by',
		'shipped_at',
	];

    public function order()
	{
		return $this->belongsTo(\App\Models\Order::class);
	}
}
