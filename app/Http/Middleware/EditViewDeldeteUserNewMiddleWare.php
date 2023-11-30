<?php

namespace App\Http\Middleware;

use App\Models\News;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EditViewDeldeteUserNewMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $postId = $request->route('id');

        $news = News::find($postId);

        if (!$news || auth()->id() != $news->user_id) {
            return back()->with('error', 'Bạn chỉ được xem, sửa ,thêm bài viết tiếng anh, xóa bài viết của chính mình');
        }

        return $next($request);
    }
}
