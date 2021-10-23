<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    public function group() {
      return $this->belongsTo(CityGroup::class, 'city_group_id');
    }
}
