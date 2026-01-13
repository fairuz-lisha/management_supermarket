<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Log guard status for debugging redirect loops
        try {
            $guardCheck = Auth::guard('admin')->check();
        } catch (\Exception $e) {
            Log::error('AdminAuth guard check failed: ' . $e->getMessage());
            $guardCheck = false;
        }

        Log::info('AdminAuth middleware: guard_check', ['guard_check' => $guardCheck, 'path' => $request->path(), 'session_id' => $request->session()->getId()]);

        // Cek apakah sudah login sebagai admin
        if (!$guardCheck) {
            Log::info('AdminAuth middleware redirecting to admin.login', ['path' => $request->path()]);
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        return $next($request);
    }
}
