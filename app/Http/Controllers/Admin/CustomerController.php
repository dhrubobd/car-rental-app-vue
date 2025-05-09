<?php

namespace App\Http\Controllers\Admin;

use App\Helper\JWTToken;
use App\Http\Controllers\Controller;
use App\Models\rental;
use App\Models\user;
use Exception;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{

    function createCustomer(Request $request){
        return Inertia::render('Backend/Customers/AddCustomer');
    }
    function saveCustomer(Request $request){
        try {
            $request->validate([
                'name' => 'required|string||max:100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:6',
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'role' => 'customer',
                'password' => $request->password,
            ]);

            return redirect()->route('dashboard.customers')->with('success', 'User created successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    function editCustomer(String $id){
        $customerID=$id;
        $theCustomer = User::where('id',$customerID)->first();
        return Inertia::render('Backend/Customers/EditCustomer', [
            'customer' => $theCustomer,
        ]);
    }
    function updateCustomer(Request $request, String $id){
        try {
            $request->validate([
                'name' => 'required|string|max:100',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'password' => 'nullable|string|min:6',
            ]);

            $user = User::findOrFail($id);

            $data = [
                'name' => $request->name,
                'email'=> $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ];

            if($request->filled('password')) {
                $data['password'] = $request->password;
            }

            $user->update($data);

            return redirect()->route('dashboard.customers')->with('success', 'User updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
    function deleteCustomer(String $id){
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('dashboard.customers')->with('success','Customer deleted successfully.');
    }
}
