<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role_id' => 'required',
            'room_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên Không được để Trống.',
            'email.required' => 'Tên Không được để Trống.',
            'password.required' => 'Mật Khẩu Không được để Trống.',
            'role_id.required' => 'Chọn Phòng Ban',
            'room_id.required' => 'Chọn Chức Vụ',
        ]
    }
}
