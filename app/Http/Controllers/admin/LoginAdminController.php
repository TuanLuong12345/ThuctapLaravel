<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class LoginAdminController extends Controller
{
    public function index()
    {
        if (Auth::id() > 0) {
            return redirect()->route('dashboard.index');
        }
        return view('login.login');
    }

    public function login(AuthRequest $request)
    {
        {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];
            if (Auth::attempt($credentials)) {
                return redirect()->route('dashboard.index');
            }
            toastr()->error('Email hoặc mật khẩu không chính xác');
            return redirect()->route('login');
        }
    }

}
