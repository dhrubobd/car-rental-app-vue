<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PageController extends Controller
{
    function homePageView(){
        $cars = Car::where('availability',true)->orderBy('updated_at', 'desc')->limit(8)->get();
        return Inertia::render('Home',[
            'cars'=>$cars,
        ]);
    }
    function dashboardView(){
        $user = Auth::user();
        $userID = $user->id;
        $rentals = Rental::where('user_id',$userID);
        return inertia('Frontend/Dashboard');
    }
}
