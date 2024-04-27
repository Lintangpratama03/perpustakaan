<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CheckLastActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $expiresAt = now()->addMinutes(20); // Batas waktu 30 menit
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);

            if (Cache::has('user-is-online-' . Auth::user()->id)) {
                return $next($request);
            }

            Auth::logout();
            return redirect()->route('sign-in')->withErrors(['session_expired' => 'Sesi Anda telah berakhir karena tidak ada aktivitas dalam waktu yang cukup lama.']);
        }

        return $next($request);
    }
}
