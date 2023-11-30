<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ProfileAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        {
            $requestedUserId = $request->route('id');
            $authenticatedUserId = auth()->id();
            $authenticatedUserRole = auth()->user()->role;

            if ($authenticatedUserId == $requestedUserId) {
                return $next($request);
            }

            if ($authenticatedUserRole === 'admin') {
                $requestedUserRole = DB::table('users')->where('id', $requestedUserId)->value('role');

                if ($requestedUserRole !== 'admin') {
                    return $next($request);
                }
            }
            toastr()->error('Bạn không có quyền sửa đổi thông tin của người này');
            abort(Response::HTTP_NOT_FOUND); // Chuyển hướng đến trang lỗi 404 cho truy cập không được phép
        }
    }
}
