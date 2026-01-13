<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        // Jika sudah login, redirect ke dashboard
        try {
            $guardCheck = Auth::guard('admin')->check();
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('AdminAuthController showLogin guard check failed: ' . $e->getMessage());
            $guardCheck = false;
        }

        \Illuminate\Support\Facades\Log::info('AdminAuthController showLogin: guard_check', ['guard_check' => $guardCheck, 'session_id' => session()->getId()]);

        if ($guardCheck) {
            \Illuminate\Support\Facades\Log::info('AdminAuthController showLogin redirecting to dashboard');
            return redirect()->route('admin.dashboard');
        }

        return view('auth.admin_login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi'
        ]);

        $credentials = $request->only('email', 'password');

        // Coba login
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
        }

        // Jika gagal
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login')
            ->with('success', 'Berhasil logout');
    }
}