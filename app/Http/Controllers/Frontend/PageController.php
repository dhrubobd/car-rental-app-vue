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

    function carPageView(Request $request){
        $search = $request->input("search");
        $min_price = $request->input("min_price");
        $max_price = $request->input("max_price");

        $cars = Car::query();

        if (!empty($search)) {
            $cars = Car::where('availability',true)
            ->whereAny([
                'name',
                'brand',
                'model',
                'year',
                'car_type',
            ], 'like', "%$search%");
        }
        if (!empty($min_price)) {
            $cars = $cars->where('availability',true)
            ->where(function ($query) use ($min_price) {
                $query->where("daily_rent_price", ">=", $min_price);
            });
        }

        if (!empty($max_price)) {
            $cars = $cars->where('availability',true)
            ->where(function ($query) use ($max_price) {
                $query->where("daily_rent_price", "<=", $max_price);
            });
        }
        return Inertia::render('Frontend/Cars',[
            'cars'=>$cars->orderBy('updated_at', 'desc')->get(),
        ]);
    }

    function carDetailsView(String $id){
        $car = Car::where('id',$id)->first();
        return Inertia::render('Frontend/CarDetails',[
            'car'=>$car,
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
