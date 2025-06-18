<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek role dan redirect
            if ($user->role_user_id == 3) {
                return redirect()->intended('/dashboard');
            } elseif ($user->role_user_id == 4) {
                return redirect()->intended('/');
            } else {
                Auth::logout();
                return redirect()->route('login')->withErrors(['role' => 'Role tidak dikenali.']);
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function showResetForm()
    {
        return view('auth.passwords.reset');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // Here you would typically implement password reset logic
        // For now, we'll just redirect back with a message
        return back()->with('status', 'Password reset link sent to your email!');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role_user_id' => 4, // Set role as user
        ]);

        // Auto login after registration
        Auth::login($user);

        return redirect('/')->with('success', 'Registration successful! Welcome to our platform.');
    }
}