<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255|exists:users',
            'password' => 'required|min:8|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'password_confirmation'=>'required|same:password',
        ];
    }
    public function messages(): array
    {
        return ([
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Bạn chưa nhập  đúng định dạng email . Ví dụ : 1234@gmail.com',
            'email.max' => 'Email của bạn quá dài',
            'email.exists' => 'Email không tồn tại trong hệ thống.',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu của bạn quá ngắn',
            'password.max' => 'Mật khẩu của bạn quá dài',
            'password.regex' => 'Mật khẩu của bạn phải có độ dài ít nhất là 8 bao gồm ít nhất 1 chữ hoa,
                                 1 chữ thường ,1 số và 1 kí tự đặc biệt ',
            'password_confirmation.required'=>'Bạn chưa nhập lại mật khẩu',
            'password_confirmation.same'=>'Mật khẩu nhập vào không trùng khớp',
        ]);
    }
}
