<?php

namespace App\Models;

use App\Http\Resources\CampaignResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityGroup extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    public function cities() {
      return $this->hasMany(City::class);
    }

    public function campaign() {
      return $this->belongsTo(Campaign::class);
    }
}
