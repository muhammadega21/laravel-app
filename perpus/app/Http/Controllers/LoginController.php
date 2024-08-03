<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
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
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            Auth::user()->role == 3 ? $name = Auth::user()->siswa->name : $name = Auth::user()->petugas->name;
            return redirect()->intended('/dashboard')->with('toastSuccess', 'Selamat Datang ' . $name);
        }

        return back()->with('error', 'Email atau Password Salah');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|email:dns|unique:users,email',
            'username' => 'required|max:8',
            'password' => 'required|min:4'
        ], [

            'name.required' => 'Nama Tidak Boleh Kosong!',
            'name.unique' => 'Nama Sudah Ada!',
            'name.max' => 'Nama Maksimal 30 Character!',

            'email.required' => 'Email Tidak Boleh Kosong!',
            'email.email' => 'Email Harus Berupa Email Yang Benar!',
            'email.unique' => 'Email Sudah Ada!',

            'username.required' => 'Username Tidak Boleh Kosong!',
            'username.max' => 'Username Maksimal 8 Character!',

            'password.required' => 'Password Tidak Boleh Kosong!',
            'password.min' => 'Password Minimal 4 Character!',
        ]);

        // id_siswa
        $lastId = Siswa::latest('id_siswa')->first();
        $nextId = $lastId ? substr($lastId->id_siswa, 1) + 1 : 1;
        $idSiswa = 'S' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        $user = User::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password'))
        ]);

        Siswa::create([
            'id_siswa' => $idSiswa,
            'user_id' => $user->id,
            'username' => $request->input('username'),
            'name' => $request->input('name'),
        ]);

        return redirect('/login')->with('success', 'Berhasil mendaftar, silahkan login');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil Logout');
    }
}
