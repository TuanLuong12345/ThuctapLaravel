<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EditDeletedUserMiddleware
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        $userId = $request->route('id');

        try {
            $userToModify = User::findOrFail($userId);

            if ($user && $user->role === 'admin') {
                if ($user->id === $userToModify->id || $userToModify->role !== 'admin') {
                    return $next($request);
                } else {
                    return redirect()->route('users.index')->with('error', 'Bạn không thể sửa hoặc xóa người dùng admin khác.');
                }
            }

            return redirect('/')->with('error', 'Bạn không có quyền thực hiện thao tác này.');
        } catch (ModelNotFoundException $e) {
            return abort(404); // Chuyển hướng đến trang 404 Not Found
        }
    }

}
