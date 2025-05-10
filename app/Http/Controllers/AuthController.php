<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Helpers\MailerHelper;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function registerPage()
    {
        return Inertia::render('Registration');
    }

    public function register(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'role' => 'customer',
                'password' => Hash::make($request->password),
            ]);
    
            return redirect()->route('login')->with('success','Registration Success');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Registration Unsuccessful');
        }
        

    }
    public function loginPage()
    {
        return Inertia::render('Login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email  = $request->input('email');
        $password = $request->input('password');

        if (!Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->back()->with('error','Invalid credentials');
        }

        $user = Auth::user();
        
        if ($user->role !== 'admin') {
            return  redirect()->route('customer.dashboard')->with('success','Login successful');

        }else{
            return  redirect()->route('dashboard')->with('success','Login successful');
        }
        
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return Inertia::render('Login');
    }
}