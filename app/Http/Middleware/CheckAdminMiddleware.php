<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CheckAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (Auth::check()) {
            // Lấy thông tin người dùng và kiểm tra vai trò
            $user = Auth::user();
            if ($user->role !== 'admin') {
                return redirect()->route('dashboard.index')->with('error', 'Chỉ admin mới  có quyền truy cập trang này.');
            }
        }

        return $next($request);
    }
}
