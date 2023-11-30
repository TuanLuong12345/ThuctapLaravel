<?php

namespace App\Http\Middleware;

use App\Models\News;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EditDeleteNewsMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle($request, Closure $next)
    {
        $id = $request->route('id');
        $news = News::findOrFail($id);
        $id_news = $news->user_id;
        $user = User::find($id_news)->role;
        if (Auth::user()->role === 'admin') {
            // Nếu người dùng là admin, cho phép chỉnh sửa bài viết của user hoặc chính họ
            if ($news->user_id !== Auth::id() && $user === 'admin') {
                return redirect()->route('news.index')
                    ->with('error', 'Bạn không thể chỉnh sửa hay xóa,
                    thêm bài viết tiếng anh của admin khác');
            }
        } elseif ($news->user_id !== Auth::id()) {
            // Ngăn chặn người dùng thông thường chỉnh sửa bài viết của người khác
            return redirect()->route('news.index')
                ->with('error', 'Bạn chỉ có thể chỉnh sửa, xóa, thêm bài viết tiếng anh của chính mình');
        }
        return $next($request);
    }
}
