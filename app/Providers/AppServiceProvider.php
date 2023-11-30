<?php

namespace App\Providers;

use App\Models\Info;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
//use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Laravel\Passport\Passport;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function composeUserData()
    {
        View::composer('*', function ($view) {
            // Lấy thông tin người dùng hiện tại
            $currentUser = auth()->user();

            // Chia sẻ thông tin người dùng với tất cả view
            $view->with('currentUser', $currentUser);
        });
    }
    public function composerUserInforType()
    {
        // Sử dụng View Composer để chia sẻ thông tin với tất cả view
        View::composer('*', function ($view) {
            $info_type = Info::all();
            $view->with('info_type', $info_type);
        });
    }
    public function boot():void
    {
        $this->composeUserData();
        $this->composerUserInforType();
        Schema::defaultStringLength(255);
        Paginator::useBootstrap();
        Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
        Passport::hashClientSecrets();
        Passport::tokensExpireIn(now()->addDays(15));


    }
}
