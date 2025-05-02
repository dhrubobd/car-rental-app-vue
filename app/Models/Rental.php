<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Car;
use App\Models\User;

class Rental extends Model
{
    protected $fillable = ['user_id','car_id','start_date','end_date','total_cost','status'];
    public function car():BelongsTo{
        return $this->belongsTo(Car::class);
    }
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
