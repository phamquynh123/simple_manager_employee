<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'oldpass' => 'required',
            'newpass' => 'required',
            'confirmpass' => 'required|same:newpass',
        ];
    }

    public function messages()
    {
        return [
            'oldpass.required' =>  'Nhập Mật Khẩu Cũ.',
            'newpass.required' => 'Nhập Mật Khẩu Mới.',
            'confirmpass.required' => 'Nhập Xác Nhận Mật Khẩu.',
            'confirmpass.same:newpass' => 'Mật Khẩu Mới Và Xác Nhận Mật Khẩu Chưa Trùng Nhau.',
        ];
    }
}
