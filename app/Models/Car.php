<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Rental;

class Car extends Model
{
    protected $fillable = ['name','brand','model','year','car_type','daily_rent_price','availability','image'];
    public function rentals(): HasMany{
       return $this->hasMany(Rental::class);
    }
}
