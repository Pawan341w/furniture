<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Show Login Form
    public function showLoginForm()
    {
        return view('auth.login'); // resources/views/auth/login.blade.php
    }

    // Handle Login
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required|min:6',
        ]);
        
         $loginType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';


// return $loginType;
       if (Auth::attempt([$loginType => $request->login, 'password' => $request->password])) {
            $request->session()->regenerate();

        $user = Auth::user();

        // Redirect based on role
           if ($user->hasRole(['admin', 'user'])) {
                    return redirect()->intended('/')->with('success', 'Welcome User!');
            }
            else {
                    Auth::logout();
                    return redirect()->route('login')->withErrors([
                        'login' => 'No role assigned to your account.'
                    ]);
            }
        }


        return back()->withErrors([
            'login' => 'Invalid credentials.'
        ])->withInput();
    }

    // Show Register Form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle Register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile'   => 'required|string|max:15|unique:users,mobile',
            'password' => 'required|min:6|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        
        
        // Handle image upload
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('profile_images', 'public');
    }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'profile_image' => $imagePath, // Save the image path
        ]);

        $user->assignRole('user');
        Auth::login($user);

        return redirect('/')->with('success', 'Registration successful!');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'You have been logged out.');
    }
}
