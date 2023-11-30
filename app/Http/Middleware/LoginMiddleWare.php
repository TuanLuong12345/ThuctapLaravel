<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class LoginMiddleWare
{
    public function handle(Request $request, Closure $next): Response
    {
         if(Auth::id()== null)
         {
             toastr()->error('Bạn cần đăng nhập để sử dụng chức năng này');
             return redirect()->route('login')->with('Error','Bạn cần đăng nhập để sử dụng chức năng này');
         }
        return $next($request);
    }
}
