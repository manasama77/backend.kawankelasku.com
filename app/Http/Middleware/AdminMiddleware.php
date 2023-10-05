<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('id') || !session('email') || !session('full_name') || !session('token') || !session('admin_time_expired')) {
            return redirect()->route('logout');
        }

        $now                = Carbon::now();
        $admin_time_expired = Carbon::parse(session('admin_time_expired'));

        $is_expired = $admin_time_expired->lte($now);
        if ($is_expired === true) {
            return redirect()->route('logout');
        } else {
            $new_expired = $now->addHours(2)->format('Y-m-d H:i:s');
            session(['admin_time_expired' => $new_expired]);
        }

        return $next($request);
    }
}
