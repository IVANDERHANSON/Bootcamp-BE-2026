<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    function getRegister() {
        return view('register');
    }

    function getLogin() {
        return view('Login');
    }

    function postRegister(Request $request) {
        $credentials = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
        ]);

        $newUser = $credentials;
        $newUser['password'] = Hash::make($credentials['password']);
        User::create($newUser);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect(route('home'));
        }
        
        return back()->with('failed', 'The provided credentials do not match our records.');
    }

    function postLogin(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect(route('home'));
        }
        
        return back()->with('failed', 'The provided credentials do not match our records.');
    }

    function logout(Request $request) {
        Auth::logout();
 
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect(route('home'));
    }
}
