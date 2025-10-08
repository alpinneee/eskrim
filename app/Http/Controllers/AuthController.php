<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show login form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Handle login POST
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            if ($user->role === 'kasir') {
                return redirect()->route('cashier.dashboard');
            }
            if ($user->role === 'pelanggan') {
                return redirect()->route('pelanggan.dashboard');
            }
            return redirect('/');
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    // Show register form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Handle register POST
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6', 'confirmed'],
            'role' => ['required'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'],
        ]);

        Auth::login($user);
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        if ($user->role === 'kasir') {
            return redirect()->route('cashier.dashboard');
        }
        if ($user->role === 'pelanggan') {
            return redirect()->route('pelanggan.dashboard');
        }
        return redirect('/');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
