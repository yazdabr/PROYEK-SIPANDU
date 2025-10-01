<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->email === 'manajemen@gmail.com') {
                return redirect()->route('manajemen.dashboard'); 
            } elseif ($user->email === 'uptmb@gmail.com') {
                return redirect()->route('uptmb.dashboard');
            } elseif ($user->email === 'ppid@gmail.com') {
                return redirect()->route('ppid.ppidstatis');
            } elseif ($user->email === 'upkmb@gmail.com') {
                return redirect()->route('upkmb.dashboard'); 
            } elseif ($user->email === 'upsiaran@gmail.com') {
                return redirect()->route('upsiaran.dashboard'); 
            } elseif ($user->email === 'upkeuangan@gmail.com') {
                return redirect()->route('upkeuangan.dashboard'); 
            } elseif ($user->email === 'uplpu@gmail.com') {
                return redirect()->route('uplpu.dashboard'); 
            } elseif ($user->email === 'upsdm@gmail.com') {
                return redirect()->route('upsdm.dashboard'); // ✅ Tambahan untuk SDM
            }
        }

        return view('login'); 
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $email = $user->email;

            $request->session()->regenerate();

            if ($email === 'manajemen@gmail.com') {
                return redirect()->route('manajemen.dashboard'); 
            } elseif ($email === 'uptmb@gmail.com') {
                return redirect()->route('uptmb.dashboard');
            } elseif ($email === 'ppid@gmail.com') {
                return redirect()->route('ppid.ppidstatis');
            } elseif ($email === 'upkmb@gmail.com') {
                return redirect()->route('upkmb.dashboard'); 
            } elseif ($email === 'upsiaran@gmail.com') {
                return redirect()->route('upsiaran.dashboard'); 
            } elseif ($email === 'upkeuangan@gmail.com') {
                return redirect()->route('upkeuangan.dashboard'); 
            } elseif ($email === 'uplpu@gmail.com') {
                return redirect()->route('uplpu.dashboard'); 
            } elseif ($email === 'upsdm@gmail.com') {
                return redirect()->route('upsdm.dashboard'); // ✅ Tambahan untuk SDM
            } else {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/')->withErrors(['email' => 'Akun Anda tidak memiliki izin akses ke sistem.']);
            }
        }

        return back()->withErrors([
            'email' => 'Email atau Kata Sandi salah.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
