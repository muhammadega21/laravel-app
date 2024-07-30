<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth()->user();
        if ($user->role == 1) {
            $user = Auth()->user()->petugas;
        } else {
            $user = Auth()->user()->siswa;
        }

        return view('profile', [
            'title' => "Profile",
            'main_page' => '',
            'page' => 'Profile',
            'data' => $user,
        ]);
    }

    public function update(Request $request)
    {
        if (Auth()->user()->role == 1) {
            $data = Auth()->user()->petugas;
        } else {
            $data = Auth()->user()->siswa;
        }
        $rules = [
            'name' => 'required|max:30',
            'username' => 'required|max:8',
            'no_telp' => 'max:15',
            'alamat' => 'max:100',
            'image' => 'image|file|max:3000',
        ];

        $validator = Validator::make($request->all(), $rules, [
            'name.required' => 'Nama Tidak Boleh Kosong!',
            'name.max' => 'Nama Maksimal 30 Karakter!',

            'username.required' => 'Username Tidak Boleh Kosong!',
            'username.max' => 'Username Maksimal 8 Karakter!',

            'email.required' => 'Email Tidak Boleh Kosong!',
            'email.email' => 'Email Harus Berupa Email Yang Benar!',
            'email.unique' => 'Email Sudah Ada!',

            'image.image' => 'File Harus Berupa Gambar!',
            'image.max' => 'Size Gambar Tidak Boleh Lebih Dari 3mb!',

            'no_telp.max' => 'Nomor Telepon Maksimal 30 Karakter!',

            'alamat.max' => 'Alamat Maksimal 30 Karakter!',
        ]);

        if ($request->email != $data->user->email) {
            $rules['email'] = 'required|email:dns|unique:users,email';
        }


        $image = $request->oldImage;
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $image = $request->file('image')->store('user-profile');
        }

        User::where('email', $data->user->email)->update([
            'email' => $request->email,
        ]);

        $data->update([
            'name' => $request->name,
            'username' => $request->username,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'image' => $image,
        ]);

        return redirect('/profile')->with('success', 'Profile Berhasil Dirubah');
    }
}
