<?php

namespace App\Http\Controllers\Admin;

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
    function listCustomer(Request $request)
    {
        if ($this->isAdmin($request) == true) {
            return User::where('role', 'customer')->orderBy('updated_at', 'desc')->get();
        } else {
            return view('page.auth.login-page');
        }
    }

    function listAvailableCar(Request $request)
    {
        if ($this->isAdmin($request) == true) {
            return Car::where('availability', true)
                ->orderBy('updated_at', 'desc')->get();
        } else {
            return view('page.auth.login-page');
        }
    }

    function createRental(Request $request)
    {
        $customers = User::where('role', 'customer')->orderBy('updated_at', 'desc')->get();
        $cars = Car::where('availability', true)
            ->orderBy('updated_at', 'desc')->get();
        return inertia('Backend/Rentals/AddRental', [
            'customers' => $customers,
            'cars' => $cars,
        ]);
    }
    function saveRental(Request $request)
    {
        $request->validate(
            [
                'customer' => 'required',
                'car' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'booking_days' => 'required|numeric',
            ]
        );
        try {
            $userID = $request->input('customer');
            $carID = $request->input('car');
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
                $user = User::where('id',$userID)->first();
                $customerEmail = $user->email;
                $customerName = $user->name;
                $car = Car::where('id',$carID)->first();
                $carName = $car->name;
                Mail::to($customerEmail)->send(new CarRentalMail($customerName, $carName, $startDate, $endDate,$totalCost));
                return redirect()->route('dashboard.rentals')->with('success', 'Rental Created Successfully');
            } else {
                return  redirect()->back()->with('error', 'The Car is already Booked for the date range');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Rental Creation Failed');
        }
    }

    function rentalByID(Request $request)
    {
        if ($this->isAdmin($request) == true) {
            $rentalID = $request->input('id');
            return Rental::where('id', $rentalID)->first();
        } else {
            return view('page.auth.login-page');
        }
    }
    function deleteRental(String $id)
    {
        /*
        if ($this->isAdmin($request) == true) {
            $rentalID = $request->input('id');
            return Rental::where('id', $rentalID)->delete();
        } else {
            return view('page.auth.login-page');
        }
        */
        try {
            Rental::where('id', $id)->delete();
            return redirect()->route('dashboard.rentals')->with('success', 'Rental Deleted Successfully');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Rental Deletion Failed');
        }
    }
    function editRental(String $id)
    {
        $rental = Rental::where('id', $id)->first();
        $customers = User::where('role', 'customer')->get();
        $cars = Car::where('availability', true)->get();
        return inertia('Backend/Rentals/EditRental', [
            'rental' => $rental,
            'customers' => $customers,
            'cars' => $cars,
        ]);
    }

    function updateRental(Request $request, String $id)
    {
        /*
        if ($this->isAdmin($request) == true) {
            $rentalID = $request->input('rentalID');
            $rentalStatus = $request->input('rentalStatus');
            return Rental::where('id', $rentalID)->update([
                'status' => $rentalStatus,
            ]);
        } else {
            return view('page.auth.login-page');
        }
        */
        $request->validate(
            [
                'customer' => 'required',
                'car' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'booking_days' => 'required|numeric',
                'status' => 'required|in:ongoing,completed,cancelled',
            ]
        );
        try {
            $rentalID = $id;
            $userID = $request->input('customer');
            $carID = $request->input('car');
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            $bookingDays = $request->input('booking_days');
            $status = $request->input('status');
            $totalCost = 0;
            if ($status == 'ongoing') {
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
                } else {
                    return  redirect()->back()->with('error', 'The Car is already Booked for the date range');
                }
                Rental::where('id', $rentalID)->update([
                    'user_id' => $userID,
                    'car_id' => $carID,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'status' => $status,
                    'total_cost' => $totalCost,
                ]);
                return redirect()->route('dashboard.rentals')->with('success', 'Rental Updated Successfully');
            } else {
                Rental::where('id', $rentalID)->update([
                    'status' => $status,
                ]);
                return redirect()->route('dashboard.rentals')->with('success', 'Rental Updated Successfully');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Rental Update Failed');
        }
    }

    function isAdmin(Request $request)
    {
        $userID = $request->header('id');
        $theUser = User::where('id', '=', $userID)
            ->select(['role'])->first();
        if ($theUser->role == "admin") {
            return true;
        } else {
            return false;
        }
    }
}
