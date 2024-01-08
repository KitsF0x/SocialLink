<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    // Forms
    public function registerForm()
    {
        return view('auth.register');
    }
    public function loginForm()
    {
        return view('auth.login');
    }
    // Actions
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        $this->login($request);
        return redirect()->route('home.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect(route('home.index'));
        } else {
            return redirect()->back()->withErrors(['error' => 'Something went wrong']);
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        return redirect(route('home.index'));
    }
}
