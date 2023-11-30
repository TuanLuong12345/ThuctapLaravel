<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        return ([
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|max:255|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
            'confirmPassword'=>'required|same:password',
            'name' => 'required|min:4|max:255',
            'phone' => 'required|unique:users,phone|regex:/^0[0-9]{9}$/',
            'role' => 'required'
        ]);
    }
    public function messages(): array
    {
        return ([
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Bạn chưa nhập  đúng định dạng email . Ví dụ : 1234@gmail.com',
            'email.max' => 'Email của bạn quá dài',
            'email.unique'=>'Email đã được sử dụng',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu của bạn quá ngắn',
            'password.max' => 'Mật khẩu của bạn quá dài',
            'password.regex' => 'Mật khẩu của bạn phải có độ dài ít nhất là 8 bao gồm ít nhất 1 chữ hoa,
                                 1 chữ thường ,1 số và 1 kí tự đặc biệt ',
            'confirmPassword.required'=>'Bạn chưa nhập lại mật khẩu',
            'confirmPassword.same'=>'Mật khẩu nhập vào không trùng khớp',
            'name.required' => 'Bạn chưa nhập tên',
            'name.max' => 'Tên của bạn quá dài',
            'name.min' => 'Tên của bạn quá ngắn ',
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã được sử dụng',
            'phone.regex' => 'Số điện thoại không đúng bao gồm 10 số và bắt đầu bằng số 0',
            'role.required' => 'Bạn chưa nhập vai trò',
        ]);
    }

}
