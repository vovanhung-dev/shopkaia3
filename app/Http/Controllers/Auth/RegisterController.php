<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Hiển thị form đăng ký
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Xử lý đăng ký tài khoản mới
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255|regex:/^[a-zA-ZÀ-ỹ\s]+$/',
            'email' => 'required|string|email:rfc,dns|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
            'terms' => 'required|accepted',
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'name.min' => 'Họ tên phải có ít nhất 2 ký tự.',
            'name.max' => 'Họ tên không được vượt quá 255 ký tự.',
            'name.regex' => 'Họ tên chỉ được chứa chữ cái và khoảng trắng.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không đúng định dạng.',
            'email.unique' => 'Email này đã được sử dụng.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
            'password.regex' => 'Mật khẩu phải chứa ít nhất 1 chữ thường, 1 chữ hoa và 1 số.',
            'terms.required' => 'Vui lòng đồng ý với điều khoản sử dụng.',
            'terms.accepted' => 'Bạn phải đồng ý với điều khoản sử dụng.',
        ]);

        // Lấy vai trò người dùng
        $userRole = Role::where('slug', 'user')->first();
        if (!$userRole) {
            // Nếu không tìm thấy vai trò, tạo mới
            $userRole = Role::create([
                'name' => 'Người dùng',
                'slug' => 'user',
            ]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $userRole->id,
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }
} 