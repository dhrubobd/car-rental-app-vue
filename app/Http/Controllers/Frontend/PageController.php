<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PageController extends Controller
{
    function homePageView(){
        $cars = Car::where('availability',true)->orderBy('updated_at', 'desc')->limit(8)->get();
        return Inertia::render('Home',[
            'cars'=>$cars,
        ]);
    }
    function customerCarsView(){
        return view('page.customer.cars');
    }
    function manageBookingView(){
        //return view('page.customer.manage-bookings');
        return inertia('Frontend/Booking/ManageBooking');
    }
}
