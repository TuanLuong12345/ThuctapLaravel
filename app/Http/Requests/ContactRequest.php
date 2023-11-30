<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|regex:/^0[0-9]{9}$/',
            'title' => 'required|string|max:255',
            'content' => 'required|min:50',
        ];
    }

    public function messages(): array
    {
        return ([
            'name.required' => 'Bạn chưa nhập tên',
            'name.string' => 'Tên của bạn chưa sai kiểu dữ liệu',
            'name.max' => 'Tên của bạn quá dài(quá 255 kí tự)',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Email của bạn nhập chưa đúng!! Ví du: 12345abc@gmail.com',
            'email.max' => 'Email của bạn quá dài(quá 255 kí tự)',
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.string' => 'Số điện thoại của bạn nhập chưa đúng định dạng',
            'phone.regex' => 'Số điện thoai của bạn phải gồm 10 số và bắt đầu bằng số 0',
            'title.required' => 'Bạn chưa nhập tiêu đề',
            'title.string' => 'Tiêu đề của bạn chưa đúng kiểu dữ liệu',
            'title.max' => 'Tiêu đề của bạn quá dài',
            'content.required' => 'Bạn chưa nhập nội dung',
            'content.min' => 'Nội dung bạn nhập phải có ít nất 50 kí tự!!!',


        ]);
    }
}
