<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
   
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('penghuni.index');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $roleName = Auth::user()->role === 'admin' ? 'Admin (Pemilik Kos)' : 'Penghuni Kos';

            return redirect()->intended(route('penghuni.index'))
                ->with('sukses', 'Selamat datang, ' . Auth::user()->name . '! Anda login sebagai ' . $roleName . '.');
        }

        
        return back()->withInput($request->only('email'))
            ->with('error', 'Email atau password yang Anda masukkan salah.');
    }

    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('sukses', 'Anda telah berhasil keluar (logout) dari sistem.');
    }
}
