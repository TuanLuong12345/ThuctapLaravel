<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UsersImport implements ToModel, WithHeadingRow
{
    protected $errorRows = [];
    protected $validRows = [];

    public function model(array $row)
    {
        $rowNumber = count($this->errorRows) + count($this->validRows) + 1;
        $validator = Validator::make($row, $this->rules(), $this->customValidationMessages());

        if ($validator->fails()) {
            $this->errorRows[] = [
                'row_number' => $rowNumber,
                'row' => $row,
                'errors' => $validator->errors()->messages(),
            ];
            return null;
        } else {
            $user = new User([
                'email' => $row['email'],
                'name' => $row['name'],
                'password' =>Hash::make( $row['password']),
                'phone' => $row['phone'],
                'role' => $row['role'],
            ]);
            $this->validRows[] = $row;
            return $user;
        }
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255',
            'name' => 'required|min:4|max:255',
            'phone' => 'required|unique:users,phone|regex:/^0[0-9]{9}$/',
            'role' => 'required',
        ];
    }
    public function customValidationMessages()
    {
        return [
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Định dạng email không đúng',
            'email.max' => 'Độ dài email quá lớn',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu quá ngắn',
            'password.max' => 'Mật khẩu quá dài',
            'name.required' => 'Bạn chưa nhập tên',
            'name.min' => 'Tên quá ngắn',
            'name.max' => 'Tên quá dài',
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'phone.regex' => 'Số điện thoại không hợp lệ',
            'role.required' => 'Bạn chưa nhập vai trò',
        ];
    }
}
