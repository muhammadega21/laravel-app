<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function login(Request $request, User $user)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('toast_success', 'Berhasil Login!' . "\n" . 'Selamat Datang ' . auth()->user()->username);
        }

        return back()->with('error', 'Email atau Password Salah');
    }

    public function register()
    {
        return view('auth.register');
    }
}
