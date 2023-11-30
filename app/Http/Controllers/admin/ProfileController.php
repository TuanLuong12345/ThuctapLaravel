<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use App\Notifications\ResetPasswordRequest;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $My_User = User::findorFail($id);
        return view('profile.index', compact('My_User'));
    }

    public function edit_profile($id)
    {
        $usersProfile = User::findorFail($id);
        return view('profile.edit', compact('usersProfile'));
    }

    public function update_profile($id, Request $request)
    {
        $roleProfile = User::find($id)->role;
        $passwordProfile = User::find($id)->password;
        try {
            User::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $passwordProfile,
                'role' => $roleProfile
            ]);
            toastr()->success('Cập nhật thông tin tài khoản của bạn thành công');
            return redirect()->route('user.profile', $id);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Messege:' . $exception->getMessage() . '----Line:' . $exception->getLine());
        }
    }

    public function change_password($id)
    {
        $User_changPassword = User::findorFail($id);
        return view('profile.change_password', compact('User_changPassword'));
    }

    public function update_password($id, Request $request)
    {
        $User_password_Update = User::find($id);
        try {
            User::where('id', $id)->update([
                'name' => $User_password_Update->name,
                'email' => $User_password_Update->email,
                'phone' => $User_password_Update->phone,
                'password' => Hash::make($request->password),
                'role' => $User_password_Update->role
            ]);
            toastr()->success('Cập nhật mật khẩu  thành công');
            return redirect()->route('user.profile');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Messege:' . $exception->getMessage() . '----Line:' . $exception->getLine());
        }
    }
}
