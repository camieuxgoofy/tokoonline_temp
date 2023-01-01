<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Uuids;
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
		'first_name', 'last_name', 'email', 'phone', 'password', 'company', 'address1', 'address2', 'province_id', 'city_id', 'postcode',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
	protected $hidden = [
		'password', 'remember_token',
	];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    	/**
	 * Define relationship with the Product
	 *
	 * @return void
	 */
	public function products()
	{
		return $this->hasMany('App\Models\Product');
	}

  public function favorites()
	{
		return $this->hasMany('App\Models\Favorite');
	}
}
