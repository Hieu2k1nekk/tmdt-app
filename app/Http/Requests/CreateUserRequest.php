<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    // Xác định người dùng có quyền gửi yêu cầu này hay không
    public function authorize()
    {
        return true; // Đặt true để tất cả người dùng đều có thể gửi yêu cầu này
    }

    // Xác thực dữ liệu
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin',
        ];
    }

    // Tùy chỉnh thông báo lỗi (nếu cần)
    public function messages()
    {
        return [
            'name.required' => 'Tên người dùng là bắt buộc.',
            'email.required' => 'Email là bắt buộc.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
//            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'role.required' => 'Vai trò là bắt buộc.',
            'role.in' => 'Vai trò không hợp lệ.',
        ];
    }
}
