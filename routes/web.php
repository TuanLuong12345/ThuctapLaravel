<?php

use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\LoginAdminController;
use App\Http\Controllers\admin\LogoutAdminController;
use App\Http\Controllers\admin\NEWSAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\home\HomeController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\user\NEWSUserController;
use App\Http\Middleware\EditDeleteNewsMiddleWare;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\ForgotPasswordController;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Middleware\EditViewDeldeteUserNewMiddleWare;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home
Route::get('/', [HomeController::class, 'welcome'])
    ->name('home.welcome');

Route::prefix('home')->middleware('set_locale')
    ->group(function () {
        Route::get('/switch-language/{locale}', [HomeController::class, 'switchLanguage'])
            ->name('switch.language');
        //Trang chủ
        Route::get('/', [HomeController::class, 'index'])
            ->name('home.index');
        //Tin tức
        Route::get('/news_all', [HomeController::class, 'news_all'])
            ->name('home.news_all');
        Route::get('/news_one/{locale}/{id}', [HomeController::class, 'news_one'])
            ->name('home.news_one');
        Route::get('/news_new/{id}', [HomeController::class, 'news_one'])
            ->name('home.news_new');
        //Liên hệ
        Route::get('/contacts', [HomeController::class, 'contact'])
            ->name('home.contacts');
        Route::post('/contact_store', [HomeController::class, 'contact_store'])
            ->name('home.contact_store');
        //Calender
        Route::get('/calender', [HomeController::class, 'calender'])
            ->name('home.calender');
        Route::get('/calender_news_day', [HomeController::class, 'news_day'])
            ->name('home.news_day');
        //Info
        Route::get('/info/{type}', [InfoController::class, 'type'])
            ->name('info.type');
        //Register
        Route::get('/register', [HomeController::class, 'register'])
            ->name('users.register');
        Route::post('/register/store', [HomeController::class, 'register_store'])
            ->name('users.register.store');
    });


//User-Bài viết của bạn
Route::prefix('user')->group(function () {
    // News
    Route::prefix('news')->middleware(['login', 'reset_password_logout', 'set_locale'])
        ->group(function () {
            Route::get('/', [NEWSUserController::class, 'index'])
                ->name('user.news.index');
            Route::get('/view/{id}', [NEWSUserController::class, 'view'])
                ->name('user.news.view')
                ->middleware(EditViewDeldeteUserNewMiddleWare::class);
            Route::get('/create', [NEWSUserController::class, 'create'])
                ->name('user.news.create');
            Route::post('/store', [NEWSUserController::class, 'store'])
                ->name('user.news.store');
            Route::get('/edit_select/{id}', [NEWSUserController::class, 'edit_select'])
                ->name('user.news.edit_select')
                ->middleware(EditViewDeldeteUserNewMiddleWare::class);
            Route::get('/edit/{id}', [NEWSUserController::class, 'edit'])
                ->name('user.news.edit')
                ->middleware(EditViewDeldeteUserNewMiddleWare::class);
            Route::post('/update/{id}', [NEWSUserController::class, 'update'])
                ->name('user.news.update');
            Route::get('/delete/{id}', [NEWSUserController::class, 'delete'])
                ->name('user.news.delete')
                ->middleware(EditViewDeldeteUserNewMiddleWare::class);
        });

    Route::prefix('news_en')->middleware(['login', 'reset_password_logout', 'set_locale'])
        ->group(function () {
            Route::post('/update_en/{id}', [NEWSUserController::class, 'update_en'])
                ->name('user.news.update_en');
            Route::post('/store_en/{id}', [NEWSUserController::class, 'store_en'])
                ->name('user.news.store_en');
        });
});

//Admin
Route::prefix('admin')->middleware('set_locale')->group(function () {
    // Logout
    Route::get('/logout', [LogoutAdminController::class, 'logout'])
        ->name('auth.logout');
    //Trang chủ Admin
    Route::get('/home', [DashboardController::class, 'index'])
        ->middleware(['login', 'reset_password_logout'])
        ->name('dashboard.index');

    //Login, thay đổi mật khẩu
    Route::prefix('login')->group(function () {
        Route::get('/', [LoginAdminController::class, 'index'])
            ->name('login');
        Route::post('/', [LoginAdminController::class, 'login'])
            ->name('login_post');
        //Reset password
        Route::get('/select_change_password', [ForgotPasswordController::class, 'select_change_password'])
            ->name('select_change_password.get');

        //Gửi link để thay đổi mật khẩu
        Route::get('/forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])
            ->name('forget.password.get');
        Route::post('/forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])
            ->name('forget.password.post');
        Route::get('/reset-password/{token}/{email}', [ForgotPasswordController::class, 'showResetPasswordForm'])
            ->name('reset.password.get');
        Route::post('/reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])
            ->name('reset.password.post');

        //Gửi mật khẩu bằng token để người dùng đăng nhập
        Route::get('/forget-password-token', [ForgotPasswordController::class, 'forget_password_token_show'])
            ->name('forget-password-token.get');
        Route::post('/forget-password-token', [ForgotPasswordController::class, 'forget_password_token_submit'])
            ->name('forget-password-token.post');
    });

    //Profile- Chỉnh sửa thông tin user
    Route::prefix('profile')->middleware(['login', 'profile_access', 'reset_password_logout'])
        ->group(function () {
            Route::get('/{id}', [ProfileController::class, 'profile'])
                ->name('user.profile');
            Route::get('/edit/{id}', [ProfileController::class, 'edit_profile'])
                ->name('user.profile.edit');
            Route::post('/update/{id}', [ProfileController::class, 'update_profile'])
                ->name('user.profile.update');
            Route::get('/change_password/{id}', [ProfileController::class, 'change_password'])
                ->name('user.profile.change_password');
            Route::post('/update_password/{id}', [ProfileController::class, 'update_password'])
                ->name('user.profile.update_password');
        });

    //Quản lý Users
    Route::prefix('users')->middleware(['login', 'check_admin', 'reset_password_logout'])
        ->group(function () {
            Route::get('/', [AdminUserController::class, 'index'])
                ->name('users.index');
            Route::get('/create', [AdminUserController::class, 'create'])
                ->name('users.create');
            Route::post('/store', [AdminUserController::class, 'store'])
                ->name('users.store');
            Route::get('/edit/{id}', [AdminUserController::class, 'edit'])
                ->name('users.edit')->middleware('edit_deleted_user');
            Route::post('/update/{id}', [AdminUserController::class, 'update'])
                ->name('users.update');
            Route::get('/delete/{id}', [AdminUserController::class, 'delete'])
                ->name('users.delete')->middleware('edit_deleted_user');
            Route::get('usersDeleteAll', [AdminUserController::class, 'deleteAll'])
                ->name('usersDeleteAll');
            Route::get('/restore/{id}', [AdminUserController::class, 'restore'])
                ->name('users.restore');
            Route::get('restoreAll', [AdminUserController::class, 'restoreAll'])
                ->name('users.restoreAll');
            Route::get('/search', [AdminUserController::class, 'search'])
                ->name('users.search');
            Route::get('/export', [AdminUserController::class, 'export'])
                ->name('users.export');
            Route::get('/export_search', [AdminUserController::class, 'export_search'])
                ->name('users.export_search');
            Route::get('/export_search_selected', [AdminUserController::class, 'export_search_selected'])
                ->name('users.export_search_selected');
            Route::post('/import', [AdminUserController::class, 'import'])
                ->name('users.import');
        });

    //News-Quản lý bài viết
    Route::prefix('news')->middleware(['check_admin', 'login', 'reset_password_logout'])
        ->group(function () {
            Route::get('/', [NEWSAdminController::class, 'index'])
                ->name('news.index');
            Route::get('/view/{id}', [NEWSAdminController::class, 'view'])
                ->name('news.view');
            Route::get('/create', [NEWSAdminController::class, 'create'])
                ->name('news.create');
            Route::post('/store', [NEWSAdminController::class, 'store'])
                ->name('news.store');
            Route::get('/edit_select/{id}', [NEWSAdminController::class, 'edit_select'])
                ->name('news.edit_select')
                ->middleware(EditDeleteNewsMiddleWare::class);
            Route::get('/edit/{id}', [NEWSAdminController::class, 'edit'])
                ->name('news.edit')
                ->middleware(EditDeleteNewsMiddleWare::class);
            Route::post('/update/{id}', [NEWSAdminController::class, 'update'])
                ->name('news.update');
            Route::get('/delete/{id}', [NEWSAdminController::class, 'delete'])
                ->name('news.delete')
                ->middleware(EditDeleteNewsMiddleWare::class);
            Route::post('/status/{id}', [NEWSAdminController::class, 'status'])
                ->name('news.status ');
        });
    Route::prefix('news_en')->middleware(['check_admin', 'login', 'reset_password_logout'])
        ->group(function () {
            Route::post('/update_en/{id}', [NEWSAdminController::class, 'update_en']
            )->name('news.update_en');
            Route::post('/store_en/{id}', [NEWSAdminController::class, 'store_en']
            )->name('news.store_en');
        });
    //Contact
    Route::prefix('contact')->middleware(['login', 'reset_password_logout', 'check_admin'])
        ->group(function () {
            //View trong trang admin
            Route::get('/contact_admin', [HomeController::class, 'contact_admin'])
                ->name('admin.contact_admin');
            Route::get('/contact_admin/view/{id}', [HomeController::class, 'contact_view'])
                ->name('admin.contact_view');
            Route::get('/contact_admin/delete/{id}', [HomeController::class, 'contact_delete'])
                ->name('admin.contact_delete');
        });
    //Info
    Route::prefix('info')->middleware(['login', 'reset_password_logout', 'check_admin'])
        ->group(function () {
            //View trong trang admin
            Route::get('/', [InfoController::class, 'index'])
                ->name('info.index');
            Route::get('/view/{id}', [InfoController::class, 'view'])
                ->name('info.view');
            Route::get('/create', [InfoController::class, 'create'])
                ->name('info.create');
            Route::post('/store', [InfoController::class, 'store'])
                ->name('info.store');
            Route::get('/edit/{id}', [InfoController::class, 'edit'])
                ->name('info.edit');
            Route::post('/update/{id}', [InfoController::class, 'update'])
                ->name('info.update');
            Route::get('/delete/{id}', [InfoController::class, 'delete'])
                ->name('info.delete');
        });
});

Route::fallback(function () {
    abort(Response::HTTP_NOT_FOUND); // lỗi 404 cho truy cập không được phép
});


