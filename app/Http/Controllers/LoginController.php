<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login'); // ini login.blade.php mu
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // redirect berdasarkan role
            switch ($user->role) {
                case 'TMB':
                    return redirect()->route('uptmb.dashboard');
                case 'SIARAN':
                    return redirect()->route('siaran.dashboard');
                case 'LPU':
                    return redirect()->route('lpu.dashboard');
                case 'KMB':
                    return redirect()->route('kmb.dashboard');
                case 'TATA USAHA KEUANGAN':
                    return redirect()->route('tuk.dashboard');
                case 'TATA USAHA UMUM':
                    return redirect()->route('tuu.dashboard');
                case 'TATA USAHA SDM':
                    return redirect()->route('tusdm.dashboard');
                case 'Operator PPID':
                    return redirect()->route('ppid.dashboard');
                case 'Manajemen':
                    return redirect()->route('manajemen.dashboard');
                default:
                    return redirect()->route('home'); // fallback
            }
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
