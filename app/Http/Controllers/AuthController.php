<?php

namespace App\Http\Controllers;

use App\Events\myevent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password'));
        }

        // Get credentials
        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');

        // Attempt to authenticate using session
        if (Auth::attempt($credentials, $remember)) {
            // Regenerate session to prevent session fixation attacks
            $request->session()->regenerate();

            return redirect()->intended('/')
                ->with('success', 'Login successful!');
        }

        // Authentication failed
        return redirect()->back()
            ->withErrors(['email' => 'Invalid credentials'])
            ->withInput($request->except('password'));
    }

    public function register(Request $request)
    {
   
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:25|min:5',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:20|confirmed',
            'role' => 'required|string|in:student,admin',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Will be auto-hashed by User model
            'role' => $request->role,
        ]);

        // Fire event
        event(new myevent($user));

        // Automatically log in the user after registration
        Auth::login($user);

        // Regenerate session
        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('success', 'Registration successful! Welcome!');
    }

    public function logout(Request $request)
    {
        // Logout the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Logged out successfully!');
    }
}

