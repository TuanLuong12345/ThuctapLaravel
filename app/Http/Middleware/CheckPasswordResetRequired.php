<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use function Laravel\Prompts\error;

class CheckPasswordResetRequired
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user->reset_password == 1) {
            $user->reset_password = 0;
            $user->save();

            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();
            toastr()->error('Mật khẩu đã được thay đổi vui lòng đăng nhập lại');
            return redirect()->route('login');
        }
        return $next($request);
    }
}
