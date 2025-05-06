<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
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
            return  redirect()->route('home')->with('success','Login successful');

        }else{
            return  redirect()->route('dashboard')->with('success','Login successful');
        }
        
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success','Logout successful');
    }
}