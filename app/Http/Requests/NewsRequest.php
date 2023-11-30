<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'title_vi' => 'required',
            'content_vi' => 'required|min:50',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    }

    public function messages(): array
    {
        return ([
            'title_vi.required' => 'Bạn chưa nhập tiêu đề',
            'content_vi.required' => 'Bạn chưa nhập nội dung',
            'content_vi.min' => 'Nội dung bạn nhập phải có ít nhất 50 kí tự!!!',
            'thumbnail.image' => 'File up lên không phải là ảnh ',
            'thumbnail.mimes' => 'Ảnh up load lên phải có 1 trong nhưng đuôi sau : jpeg,png,jpg,gif,svg',
            'thumbnail.max' => 'File up lên quá lớn(>2048KB) ',

        ]);
    }
}
