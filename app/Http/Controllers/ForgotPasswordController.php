<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Http\Requests\ResetPasswordRequest;


class ForgotPasswordController extends Controller
{
    public function select_change_password()
    {
        return view('login.select_change_password');
    }

    public function showForgetPasswordForm()
    {
        return view('login.change_password_email_link.send_password_to_email');
    }

//****Reset Password Email Link
    public function submitForgetPasswordForm(Request $request)
    {
        $email = $request->input('email');
        //nếu nhập email đã xóa in ra thông báo
        $user = User::where('email', $email)->whereNull('deleted_at')->first();
        if (!$user) {
            return back()->withInput()->with('error', 'Tài khoản đã bị xóa hoặc không tồn tại trong hệ thống.');
        }
        $request->validate([
            'email' => 'required|email|exists:users',
        ], [
            'email.required' => 'Email không được bỏ trống.',
            'email.email' => 'Bạn chưa nhập  đúng định dạng email . Ví dụ : 1234@gmail.com',
            'email.exists' => 'Email không tồn tại trong hệ thống.',
        ]);
        $token = Str::random(8);
        $expiredAt = Carbon::now()->addMinutes(15); // hoặc thời gian hết hạn mong muốn
        $email = $request->email;
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $token,
                'created_at' => Carbon::now(),
                'expired_at' => $expiredAt
            ]
        );
        Mail::send('login.change_password_email_link.email_forget_password', compact('token', 'email'),
            function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });
        return back()->with('message', 'Chúng tôi đã gửi đến mail của bạn link để reset mật khẩu');
    }

    public function showResetPasswordForm($token, $email)
    {
        $passwordResetToken = DB::table('password_reset_tokens')
            ->where('token', $token)
            ->first();
        if (!$passwordResetToken) {
            // Token không hợp lệ
            return view('login.login')->with('error', 'Liên kết đặt lại mật khẩu không hợp lệ.');
        }
        $createdTime = Carbon::parse($passwordResetToken->created_at);
        $expiredTime = $createdTime->addMinutes(15); // Thời gian hết hạn sau 15 phút
        if (Carbon::now()->gt($expiredTime)) {
            // Thời gian hết hạn, hiển thị thông báo
            return view('login.expired_password_reset_link')->with('error', 'đường link reset mật khẩu đã hết hạn');
        }
        return view('login.change_password_email_link.reset_password_link', compact('token', 'email'));
    }

    public function submitResetPasswordForm(ResetPasswordRequest $request)
    {
        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->where('expired_at', '>', Carbon::now()) // Kiểm tra token có còn hiệu lực không
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Mã không hợp lệ hoặc link reset mật khẩu đã hết hạn');
        }
        // Sử dụng model User để cập nhật mật khẩu
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->reset_password = 1;
        $user->save();
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
        return redirect()->route('login')->with('success',
            'Mật khẩu của bạn đã được cập nhật thành công ');
    }

//***Send Password To Email
    public function forget_password_token_show()
    {
        return view('login.send_password_email.send_password_to_email');
    }

    public function forget_password_token_submit(Request $request)
    {
        $email = $request->input('email');
        //nếu nhập email đã xóa in ra thông báo
        $user = User::where('email', $email)->whereNull('deleted_at')->first();
        if (!$user) {
            return back()->withInput()->with('error', 'Tài khoản đã bị xóa hoặc không tồn tại trong hệ thống.');
        }
        $request->validate([
            'email' => 'required|email|exists:users',
        ], [
            'email.required' => 'Email không được bỏ trống.',
            'email.email' => 'Bạn chưa nhập  đúng định dạng email . Ví dụ : 1234@gmail.com',
            'email.exists' => 'Email không tồn tại trong hệ thống.',
        ]);
        $password_random = Str::random(12);
        $user->password = Hash::make($password_random);
        $user->reset_password = 1;
        $user->save();
        $email = $request->email;
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            [
                'token' => $password_random,
                'created_at' => Carbon::now(),
            ]
        );
        Mail::send('login.send_password_email.email_forget_password', compact('password_random', 'email'),
            function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });
        return back()->with('message', 'Chúng tôi đã mật khẩu đến email của bạn');
    }
}
