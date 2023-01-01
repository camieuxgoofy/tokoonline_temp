<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeOption extends Model
{
    use Uuids;
    use HasFactory;
    protected $fillable = ['attribute_id', 'name'];

    public function attribute()
    {
        return $this->belongsTo('App\Models\Attribute');
    }
}
