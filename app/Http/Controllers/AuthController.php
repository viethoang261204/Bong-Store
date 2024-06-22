<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function sign_in(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Kiểm tra vai trò và điều hướng phù hợp
            if (Auth::user()->role === 'admin') {
                return redirect('/admin'); // Điều hướng đến dashboard admin
            }

            return redirect('/home'); // Điều hướng đến trang chủ cho người dùng bình thường
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function sign_out()
    {
        // Xóa giỏ hàng trong session
        Session::forget('cart');

        // Đăng xuất người dùng
        Auth::logout();

        // Đưa người dùng về trang đăng nhập hoặc trang chủ
        return redirect('/home');
    }

    public function sign_up(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'full_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        DB::table('users')->insert([
            'full_name' => $validatedData['full_name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'phone' => $validatedData['phone'],
            'address' => $validatedData['address'],
            'role' => 'customer',
            'created_at' => Carbon::now(),
        ]);

        return redirect('/sign-in')->with('success', 'Your account has been created successfully!');
    }

}

