<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan form login.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showLogin()
    {
        // Pastikan user yang sudah login tidak bisa mengakses form login
        if (Auth::check()) {
            $user = Auth::user();

            // Pengecekan 1: Manajemen
            if ($user->email === 'manajemen@gmail.com') {
                return redirect()->route('manajemen.dashboard'); 
            // Pengecekan 2: UPTMB
            } elseif ($user->email === 'uptmb@gmail.com') {
                return redirect()->route('uptmb.dashboard');
            // Pengecekan 3: PPID
            } elseif ($user->email === 'ppid@gmail.com') {
                return redirect()->route('ppid.ppidstatis');
            }
        }
        
        return view('login'); 
    }

    /**
     * Memproses permintaan login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $email = $user->email;

            // Memastikan sesi diregenerasi untuk keamanan
            $request->session()->regenerate();

            // Logika Pembatasan Akses Berdasarkan Email
            if ($email === 'manajemen@gmail.com') {
                // Arahkan ke dashboard Manajemen
                return redirect()->route('manajemen.dashboard'); 
            } elseif ($email === 'uptmb@gmail.com') {
                // Arahkan ke dashboard UPTMB
                return redirect()->route('uptmb.dashboard');
            } elseif ($email === 'ppid@gmail.com') {
                // Arahkan ke halaman PPID Statis
                return redirect()->route('ppid.ppidstatis');
            } else {
                // User berhasil login, tapi tidak memiliki email yang diizinkan
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/')->withErrors(['email' => 'Akun Anda tidak memiliki izin akses ke sistem.']);
            }
        }

        // Jika Autentikasi gagal
        return back()->withErrors([
            'email' => 'Email atau Kata Sandi salah.',
        ])->onlyInput('email');
    }

    /**
     * Keluar (Logout) dari sistem.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
