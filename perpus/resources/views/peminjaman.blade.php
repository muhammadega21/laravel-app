<x-layouts.main :title="$title" :mainPage="$main_page" :page="$page">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <h5 class="card-title">Data Peminjaman</h5>
                        <div class="btn-action">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addPeminjaman">
                                Tambah <span class="fw-semibold">+</span>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="text-nowrap">ID Pinjam</th>
                                    <th class="text-nowrap">Nama Siswa</th>
                                    <th class="text-nowrap">Judul Buku</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Petugas</th>
                                    <th data-sortable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-nowrap">{{ $data->id_pinjam }}</td>
                                        <td class="text-nowrap">{{ $data->siswa->name }}</td>
                                        <td class="text-nowrap">{{ $data->buku->judul }}</td>
                                        <td class="text-nowrap">{{ $data->tgl_pinjam }}</td>
                                        <td class="text-nowrap">{{ $data->tgl_kembali }}</td>
                                        <td class="text-nowrap">{{ $data->petugas->name }}</td>
                                        <td class="text-nowrap">
                                            <div class="d-flex gap-1">
                                                <a href="{{ url('peminjaman/delete/' . $data->id) }}"
                                                    class="badge border-danger border" onclick="confirm(event)"><i
                                                        class='bx bxs-trash text-danger'></i></a>
                                                <button type="button" class="badge bg-light border-warning border"
                                                    data-bs-toggle="modal" data-bs-target="#updatePeminjaman"
                                                    data-siswa="{{ $data }}">
                                                    <span class="fw-semibold"><i
                                                            class="bx bxs-edit text-warning"></i></span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>



                                    {{-- modal update --}}

                                    {{-- <x-modal modalTitle="Update Siswa" modalID="updatePeminjaman" btn="Update"
                                        action="" method="POST">

                                        <div class="row mb-3">
                                            <div class="input-group justify-content-between">
                                                <div class="input-box col-sm-6" style="max-width: 48%">
                                                    <label for="name"
                                                        class="col-sm-6 col-form-label required">Nama</label>
                                                    <input type="text" id="name" class="form-control "
                                                        name="name" placeholder="Masukkan Nama">
                                                </div>
                                                <div class="input-box col-sm-6" style="max-width: 48%">
                                                    <label for="username"
                                                        class="col-sm-6 col-form-label required">Username</label>
                                                    <input type="text" id="username" class="form-control "
                                                        name="username" placeholder="Masukkan Username">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="input-group col-sm-6 justify-content-between">
                                                <div class="input-box col-sm-6" style="max-width: 48%">
                                                    <label for="email"
                                                        class="col-sm-6 col-form-label required">Email</label>
                                                    <input type="email" id="email" class="form-control" disabled
                                                        placeholder="Masukkan Email">
                                                </div>
                                                <div class="input-box col-sm-6" style="max-width: 48%">
                                                    <label class="col-sm-6 col-form-label required">Password</label>
                                                    <input type="password" disabled class="form-control"
                                                        placeholder="Masukkan Password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="mb-2 required">Kelas</label>
                                            <div class="col-sm-12">
                                                <select id="kelas_id" class="form-select " name="kelas_id">
                                                    <option selected value="">- Pilih kelas -</option>
                                                </select>

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="input-group col-sm-6 justify-content-between">
                                                <div class="input-box col-sm-6" style="max-width: 48%">
                                                    <label for="nis" class="col-sm-2">NIS</label>
                                                    <input type="text" id="nis" class="form-control"
                                                        name="nis" placeholder="Masukkan NIS">

                                                </div>
                                                <div class="input-box col-sm-6" style="max-width: 48%">
                                                    <label for="inputNumber" class="">Foto Profil</label>
                                                    <input class="form-control" type="file" id="formFile">
                                                </div>
                                            </div>
                                        </div>


                                    </x-modal> --}}

                                    {{-- modal update --}}
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Select data kelas --}}
    {{-- <script>
        $(document).ready(function() {
            let kelasData =
                @json($kelas);
            let kelasSelect = $("#kelas_id");

            $.each(kelasData, function(index, kelas) {
                kelasSelect.append("<option value='" + kelas.id + "'>" + kelas.nama_kelas + "</option>");
            });
        });
    </script> --}}
    {{-- Select data kelas --}}

    {{-- Modal Tambah Peminjaman --}}

    <x-modal modalTitle="Tambah Peminjaman" modalID="addPeminjaman" btn="Tambah" action="{{ url('peminjaman') }}"
        method="POST">


        <div class="row mb-3">
            <label class="mb-2 required">Siswa</label>
            <div class="col-sm-12">
                <select class="form-select @error('siswa_id') is-invalid @enderror required" name="siswa_id">
                    <option selected value="">- Pilih Siswa -</option>
                    @foreach ($siswa as $siswa)
                        <option value="{{ $siswa->id }}" @if (old('siswa_id') == $siswa->id) selected @endif>
                            {{ $siswa->id_siswa }} - {{ $siswa->name }}</option>
                    @endforeach
                </select>
                @error('siswa_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label class="mb-2 required">Buku</label>
            <div class="col-sm-12">
                <select class="form-select @error('buku_id') is-invalid @enderror required" name="buku_id">
                    <option selected value="">- Pilih Buku -</option>
                    @foreach ($buku as $buku)
                        <option value="{{ $buku->id }}" @if (old('buku_id') == $buku->id) selected @endif>
                            {{ $buku->judul }}</option>
                    @endforeach
                </select>
                @error('buku_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="input-group justify-content-between">
                <div class="input-box col-sm-6" style="max-width: 48%">
                    <label for="tgl_pinjam" class="col-form-label required">Tanggal Pinjam</label>
                    <input type="date" id="tgl_pinjam" class="form-control @error('tgl_pinjam') is-invalid @enderror"
                        name="tgl_pinjam" placeholder="Masukkan Nama" value="{{ old('tgl_pinjam', date('Y-m-d')) }}">
                    @error('tgl_pinjam')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-box col-sm-6" style="max-width: 48%">
                    <label for="tgl_kembali" class="col-form-label required">Tanggal Kembali</label>
                    <input type="date" id="tgl_kembali"
                        class="form-control @error('tgl_kembali') is-invalid @enderror" name="tgl_kembali"
                        placeholder="Masukkan Nama" value="{{ now()->addDays(7)->format('Y-m-d') }}">
                    @error('tgl_kembali')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    </x-modal>

    {{-- Modal Tambah Peminjaman --}}

    {{-- Modal Error --}}
    @if (session('addPeminjaman'))
        <script>
            toastr.error("{{ Session::get('addPeminjaman') }}");
            $(document).ready(function() {
                $('#addPeminjaman').modal('show');
            });
        </script>
    @endif




    @if (session('updatePeminjaman'))
        <script>
            swal("Error!", "{{ Session::get('updatePeminjaman') }}", "error"), {
                button: true,
                button: 'ok'
            }
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        </script>
    @endif

    {{-- Alert --}}
    @if (Session::has('success'))
        <script>
            swal("Success!", "{{ Session::get('success') }}", "success"), {
                button: true,
                button: 'ok'
            }
        </script>
    @elseif (Session::has('error'))
        <script>
            swal("Error!", "{{ Session::get('error') }}", "error"), {
                button: true,
                button: 'ok'
            }
        </script>
    @endif
</x-layouts.main>
