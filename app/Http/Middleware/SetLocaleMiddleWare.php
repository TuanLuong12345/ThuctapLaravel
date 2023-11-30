<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;


class SetLocaleMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle($request, Closure $next)
    {
        $locale_default =config('app.locale');

        $locale_all = config('app.locale_all');

        $locale = Session::get('locale', $locale_default);
//        dd($locale);
        if (!in_array($locale, $locale_all)) {
            $locale = $locale_default;
        }
        app()->setLocale($locale);
        Session::put('locale', $locale);
        return $next($request);


    }
}
