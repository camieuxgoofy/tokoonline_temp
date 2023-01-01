<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
	use Uuids;
	protected $fillable = [
		'name',
		'wa_number',
		'email',
		'address'
	];
}
