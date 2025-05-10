<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Http\Controllers\Controller;
use App\Models\car;
use App\Models\rental;
use App\Models\user;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PageController extends Controller
{
    function dashboardView(Request $request)
    {
        try {
            $totalCars = Car::all()->count();
            $availableCars = Car::where('availability', 1)->count();
            $totalRentals = Rental::where('status', 'completed')->count();
            $totalEarnings = Rental::where('status', 'completed')->sum('total_cost');
            return Inertia::render('Backend/Dashboard', [
                'totalCars' => $totalCars,
                'availableCars' => $availableCars,
                'totalRentals' => $totalRentals,
                'totalEarnings' => $totalEarnings
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unsuccessful'
            ], 200);
        }
    }
    function manageCustomers(Request $request)
    {
        $customers = User::where('role', 'customer')->orderBy('updated_at', 'desc')->get();
        return inertia('Backend/Customers/ListCustomer', [
            'customers' => $customers,
        ]);
    }
    function customerDetails(String $id)
    {
        $customerID = $id;
        $theCustomer = User::where('id', $customerID)->first();
        $rentedCars = Rental::join('cars', 'cars.id', '=', 'rentals.car_id')
            ->where('rentals.user_id', $customerID)
            ->orderBy('updated_at', 'desc')
            ->get(['cars.name AS car_name', 'cars.brand AS car_brand', 'rentals.*']);
        return Inertia::render('Backend/Customers/CustomerDetails', [
            'customer' => $theCustomer,
            'rentals' => $rentedCars,
        ]);
    }

    function manageCars(Request $request)
    {
        try {
            $cars = Car::query()
                ->orderBy('updated_at', 'desc')->get();
            return inertia('Backend/Cars/ListCar', [
                'cars' => $cars,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unsuccessful'
            ], 200);
        }
    }

    function manageRentals(Request $request)
    {
        try {
            $rentals = Rental::join('users', 'users.id', '=', 'rentals.user_id')->join('cars', 'cars.id', '=', 'rentals.car_id')
                ->orderBy('updated_at', 'desc')
                ->get(['users.name AS customer_name', 'cars.name AS car_name', 'cars.brand AS car_brand', 'rentals.*']);
            return inertia('Backend/Rentals/ListRental', [
                'rentals' => $rentals,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unsuccessful'
            ], 200);
        }
    }
}
