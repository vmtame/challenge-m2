<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $hidden = [ 'created_at', 'updated_at' ];
    
    public function group() {
      return $this->hasOne(CityGroup::class);
    }

    public function products() {
      return $this->belongsToMany(Product::class)->withPivot('discount');
    }
}
