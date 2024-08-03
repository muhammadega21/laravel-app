<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class PetugasController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Gate::allows('bigAdmin')) {
                abort(404);
            }
            return $next($request);
        })->only(['index', 'store', 'update', 'destroy']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('master-data.petugas', [
            'title' => "Petugas",
            'main_page' => 'Master',
            'page' => 'Petugas',
            'datas' => Petugas::all()
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
        ], [

            'name.required' => 'Nama Tidak Boleh Kosong!',
            'name.max' => 'Max 30 Karakter!',

            'email.required' => 'Email Tidak Boleh Kosong!',
            'email.email' => 'Email Harus Berupa Email Yang Benar!',
            'email.unique' => 'Email Sudah Ada!',

            'username.required' => 'Username Tidak Boleh Kosong!',
            'username.max' => 'Username Maksimal 8 Karakter!',

            'password.required' => 'Password Tidak Boleh Kosong!',
            'password.min' => 'Password Minimal 4 Karakter!',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('addPetugas', 'Gagal Menambah Petugas');
        }

        // id_siswa
        $lastId = Petugas::latest('id_petugas')->first();
        $nextId = $lastId ? substr($lastId->id_petugas, 1) + 1 : 1;
        $idSiswa = 'A' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        $user = User::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 2
        ]);

        Petugas::create([
            'id_petugas' => $idSiswa,
            'user_id' => $user->id,
            'username' => $request->input('username'),
            'name' => $request->input('name'),
        ]);

        return redirect('/petugas')->with('success', 'Berhasil menambah petugas');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Petugas::where('id_petugas', $id)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:30',
            'username' => 'required|max:8',
        ], [
            'name.required' => 'Nama Tidak Boleh Kosong!',
            'name.max' => 'Max 30 Karakter!',

            'username.required' => 'Username Tidak Boleh Kosong!',
            'username.max' => 'Username Maksimal 8 Karakter!',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('updatePetugas', 'Gagal Update Petugas');
        }

        Petugas::where('id', $data->id)->update([
            'username' => $request->input('username'),
            'name' => $request->input('name'),
        ]);

        return redirect('/petugas')->with('success', 'Berhasil update petugas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $petugas = Petugas::where('id_petugas', $id)->first();
        User::destroy($petugas->user->id);
        return redirect('/petugas')->with('success', 'Berhasil menghapus data');
    }
}
