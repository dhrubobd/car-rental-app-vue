<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function isAdmin():bool{
        if (Auth::check()){
            $userID = Auth::user()->id;
            $theUser= User::where('id','=',$userID)
             ->select(['role'])->first();
            if($theUser->role=="admin"){
                return true;
            }else{
                return false;
            }
        }
    }
    public static function isCustomer():bool{
        if (Auth::check()){
            $userID = Auth::user()->id;
            $theUser= User::where('id','=',$userID)
             ->select(['role'])->first();
            if($theUser->role=="customer"){
                return true;
            }else{
                return false;
            }
        }
    }
    public function rentals():HasMany{
        return $this->hasMany(Rental::class);
    }
}
