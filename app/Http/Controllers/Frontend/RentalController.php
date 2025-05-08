<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\CarRentalMail;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RentalController extends Controller
{
    function bookCar(Request $request)
    {
        $request->validate(
            [
                'car_id' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'booking_days' => 'required|numeric',
            ]
        );
        try {
            $user = Auth::user();
            $userID = $user->id;
            $carID = $request->input('car_id');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $bookingDays = $request->input('booking_days');
            $count1 = Rental::where('car_id', $carID)
                ->where('status', '<>', 'cancelled')
                ->whereBetween('start_date', [$startDate, $endDate])->count();

            $count2 = Rental::where('car_id', $carID)
                ->where('status', '<>', 'cancelled')
                ->whereBetween('end_date', [$startDate, $endDate])
                ->count();
            if (($count1 == 0) && ($count2 == 0)) {
                $theCar = Car::where('id', $carID)->first();

                $dailyRent = $theCar->daily_rent_price;

                $totalCost = $bookingDays * $dailyRent;

                Rental::create([
                    'user_id' => $userID,
                    'car_id' => $carID,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'status' => 'ongoing',
                    'total_cost' => $totalCost,
                ]);
                $customerEmail = $user->email;
                $customerName = $user->name;
                $car = Car::where('id',$carID)->first();
                $carName = $car->name;
                Mail::to($customerEmail)->send(new CarRentalMail($customerName, $carName, $startDate, $endDate,$totalCost));
                return redirect()->route('customer.manage-booking')->with('success', 'Car is Booked Successfully');
            } else {
                return  redirect()->back()->with('error', 'The Car is already Booked for the date range');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Rental Creation Failed');
        }
    }
    function bookingList(Request $request)
    {
        $userID = $request->header('id');

        return Rental::where('user_id', $userID)->get();
    }

    function cancelBooking(Request $request)
    {
        $userID = $request->header('id');
        $bookingID = $request->input('bookingID');

        return Rental::where('id', $bookingID)->where('user_id', $userID)
            ->update([
                'status' => 'cancelled'
            ]);
    }
}
