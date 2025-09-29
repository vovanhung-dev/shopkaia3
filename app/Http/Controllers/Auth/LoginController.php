<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Hiển thị form đăng nhập
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Xử lý đăng nhập
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email:rfc|max:255',
            'password' => 'required|string|min:1',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu không được để trống.',
        ]);

        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            $request->session()->regenerate();

            // Nếu người dùng là admin, chuyển hướng đến trang admin
            if (Auth::user()->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            // Ngược lại, chuyển hướng đến trang chủ
            return redirect()->intended(route('home'));
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
} 