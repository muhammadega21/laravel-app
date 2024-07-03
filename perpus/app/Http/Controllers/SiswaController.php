<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('siswa.index', [
            'title' => "Siswa",
            'main_page' => 'Master',
            'page' => 'Siswa',
            'datas' => Siswa::all(),
            'kelas' => Kelas::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'email' => 'required|email:dns|unique:users,email',
            'username' => 'required|max:8',
            'password' => 'required|min:4',
            'kelas_id' => 'required',
            'nis' => 'required|max:10|unique:siswas,nis'
        ], [

            'name.required' => 'Nama Tidak Boleh Kosong!',
            'name.unique' => 'Nama Sudah Ada!',
            'name.max' => 'Max 30 Karakter!',

            'email.required' => 'Email Tidak Boleh Kosong!',
            'email.email' => 'Email Harus Berupa Email Yang Benar!',
            'email.unique' => 'Email Sudah Ada!',

            'username.required' => 'Username Tidak Boleh Kosong!',
            'username.max' => 'Username Maksimal 8 Karakter!',

            'password.required' => 'Password Tidak Boleh Kosong!',
            'password.min' => 'Password Minimal 4 Karakter!',

            'kelas_id.required' => 'Kelas Tidak Boleh Kosong!',

            'nis.required' => 'NIS Tidak Boleh Kosong!',
            'nis.max' => 'Max 10 Karakter!',
            'nis.unique' => 'NIS Sudah Ada!'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('addSiswa', 'Gagal Menambah Siswa');
        }

        // id_siswa
        $lastId = Siswa::latest('id_siswa')->first();
        $nextId = $lastId ? substr($lastId->id_siswa, 1) + 1 : 1;
        $idSiswa = 'S' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        $user = User::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        Siswa::create([
            'id_siswa' => $idSiswa,
            'user_id' => $user->id,
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'kelas_id' => $request->input('kelas_id'),
            'nis' => $request->input('nis')
        ]);

        return redirect('/siswa')->with('success', 'Berhasil menambah Siswa');
    }

    /**
     * Display the specified resource.
     */
    public function show(Siswa $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Siswa::where('id_siswa', $id)->first();

        $rules = [
            'name' => 'required|max:30',
            'username' => 'required|max:8',
            'kelas_id' => 'required',
        ];

        if ($request->nis != $data->nis) {
            $rules['nis'] = 'required|max:10|unique:siswas,nis';
        }

        $validator = Validator::make($request->all(), $rules, [
            'name.required' => 'Nama Tidak Boleh Kosong!',
            'name.unique' => 'Nama Sudah Ada!',
            'name.max' => 'Max 30 Karakter!',

            'username.required' => 'Username Tidak Boleh Kosong!',
            'username.max' => 'Username Maksimal 8 Karakter!',

            'kelas_id.required' => 'Kelas Tidak Boleh Kosong!',

            'nis.required' => 'NIS Tidak Boleh Kosong!',
            'nis.max' => 'Max 10 Karakter!',
            'nis.unique' => 'NIS Sudah Ada!'
        ]);



        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('updateSiswa', 'Gagal Update Siswa');
        }

        Siswa::where('id_siswa', $id)->update([
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'kelas_id' => $request->input('kelas_id'),
            'nis' => $request->input('nis'),
        ]);

        return redirect('/siswa')->with('success', 'Berhasil update siswa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::where('id_siswa', $id)->first();
        User::destroy($siswa->user->id);
        return redirect('/siswa')->with('success', 'Berhasil menghapus data');
    }
}
