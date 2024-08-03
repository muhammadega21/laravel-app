<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('error', 'Gagal Update Profile');
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

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'newpassword' => 'required|min:8|same:password_confirm',
            'password_confirm' => 'required|same:newpassword',
        ], [
            'password.required' => 'Password tidak boleh kosong.',
            'newpassword.required' => 'Password tidak boleh kosong.',
            'newpassword.min' => 'Password minimal 8 karakter.',
            'newpassword.same' => 'Konfirmasi password tidak sama.',

            'password_confirm.required' => 'password tidak boleh kosong.',
            'password_confirm.same' => 'Konfirmasi password tidak sama.',
        ]);

        $user = Auth()->user();
        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Password tidak sesuai');
        }

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Gagal ganti password');
        }

        User::where('email', $user->email)->update([
            'password' => Hash::make($request->newpassword),
        ]);

        return redirect('/profile')->with('success', 'Password berhasil dirubah');
    }

    public function deleteImage()
    {
        $user = Auth()->user();
        if ($user->role == 3) {
            if ($user->siswa->image) {
                Storage::delete($user->siswa->image);
                Siswa::where('id_siswa', $user->siswa->id_siswa)->update([
                    'image' => null,
                ]);
            } else {
                return redirect('/profile')->with('error', 'Anda menggunakan gambar default');
            }
        } else {
            if ($user->petugas->image) {
                Storage::delete($user->petugas->image);
                Petugas::where('id_petugas', $user->petugas->id_petugas)->update([
                    'image' => null,
                ]);
            } else {
                return redirect('/profile')->with('error', 'Anda menggunakan gambar default');
            }
        }
        return redirect('/profile')->with('success', 'Profile Berhasil Dirubah');
    }
}
