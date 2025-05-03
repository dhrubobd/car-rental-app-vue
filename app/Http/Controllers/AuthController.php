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
            //Auth::logout();
            //return redirect()->back()->with('error','You do not have permission to access this page');
            return Inertia::render('Home');

        }else{
            return  redirect()->route('page.dashboard')->with('success','Login successful');
        }
        
    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('page.login')->with('success','Logout successful');
    }
}