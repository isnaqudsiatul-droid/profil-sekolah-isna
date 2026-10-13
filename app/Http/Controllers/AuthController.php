<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function processLogin(Request $request)
    {
        $credentials = $request->validate(
            [
                'username' => 'required|string',
                'password' => 'required',
            ],
            [
                'username.required' => 'Username wajib diisi.',
                'password.required' => 'Password wajib diisi.',
            ]
        );

        $credentials['status'] = 'aktif';

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->intended(
                route('admin.dashboard')
            );
        }

        return back()
            ->withErrors([
                'username' =>
                    'Username atau password salah, atau akun Anda sedang tidak aktif.',
            ])
            ->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()
            ->route('public.beranda')
            ->with(
                'success',
                'Anda telah berhasil logout.'
            );
    }

    public function hitung() 
    {
        
    }
}