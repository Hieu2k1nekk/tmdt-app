<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }


    public function login(AuthRequest $request)
    {
        $title = 'Trang chủ';
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            return view('content', compact('user', 'title'))->with('susscess', 'Đăng nhập thành công');
        } else {
            return back()->withErrors([
                'email' => 'Sai email hoặc mật khẩu',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất người dùng

        // Xóa session nếu cần thiết
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/'); // Chuyển hướng về trang chủ hoặc trang đăng nhập
    }

}
