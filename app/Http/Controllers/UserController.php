<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // returns the login view
    public function create()
    {
        return view('user.login');
    }

    // returns the register view
    public function register()
    {
        return view('user.register');
    }

    // creates, validates, and logs in a new user
    public function create_user(Request $request)
    {
        $newUser = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => 'required|confirmed|min:5',
        ]);

        $newUser['password'] = Hash::make($newUser['password']);
        $user = User::create($newUser);
        auth()->login($user);

        return redirect('/home')->with('message', 'User created successfully');
    }

    // logs out the user
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'User logged out successfully');
    }

    // attempts to logs in the user
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (auth()->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/home')->with('message', 'User logged in successfully');
        }

        return back()->withErrors([
            'email' => 'Invalid Email or Password. Please try again.',
        ]);
    }
}
