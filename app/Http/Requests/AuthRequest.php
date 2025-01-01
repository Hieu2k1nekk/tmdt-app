<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Xác định xem người dùng có quyền gửi yêu cầu này hay không.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Cho phép tất cả người dùng gửi yêu cầu này
    }

    /**
     * Lấy các quy tắc xác thực cho yêu cầu này.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email', // Email là bắt buộc và phải là định dạng email
            'password' => 'required|string|min:6', // Mật khẩu là bắt buộc, là chuỗi và tối thiểu 6 ký tự
        ];
    }

    /**
     * Tùy chỉnh thông báo xác thực.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        ];
    }
}
