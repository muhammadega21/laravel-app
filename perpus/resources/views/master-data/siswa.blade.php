<x-layouts.main :title="$title" :mainPage="$main_page" :page="$page">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <h5 class="card-title">Data Siswa</h5>
                        <div class="btn-action">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addSiswa">
                                Tambah <span class="fw-semibold">+</span>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="text-nowrap">ID Siswa</th>
                                    <th class="text-nowrap">Nama</th>
                                    <th class="text-nowrap">NIS</th>
                                    <th class="text-nowrap">Kelas</th>
                                    <th data-sortable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-nowrap">{{ $data->id_siswa }}</td>
                                        <td class="text-nowrap">{{ $data->name }}</td>
                                        <td class="text-nowrap">{{ $data->nis }}</td>
                                        <td class="text-nowrap">{{ $data->kelas->nama_kelas }}</td>
                                        <td class="text-nowrap">
                                            <div class="d-flex gap-1">
                                                <a href="{{ url('siswa/show/' . $data->id_siswa) }}"
                                                    class="badge border-primary border"><i
                                                        class='bx bxs-show text-primary'></i></a>
                                                <a href="{{ url('siswa/delete/' . $data->id_siswa) }}"
                                                    class="badge border-danger border" onclick="confirm(event)"><i
                                                        class='bx bxs-trash text-danger'></i></a>
                                                <button type="button" class="badge bg-light border-warning border"
                                                    data-bs-toggle="modal" data-bs-target="#updateSiswa"
                                                    data-siswa="{{ $data }}">
                                                    <span class="fw-semibold"><i
                                                            class="bx bxs-edit text-warning"></i></span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>



                                    {{-- modal update --}}

                                    <x-modal modalTitle="Update Siswa" modalID="updateSiswa" btn="Update"
                                        action="" method="POST" enctype="multipart/form-data" method2="PUT">

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
                                            <div class="col-sm-12 selectKelas">
                                                <select id="kelas_id" class="form-control" name="kelas_id">
                                                </select>

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="input-group col-sm-6 justify-content-between">
                                                <div class="input-box col-sm-6" style="max-width: 48%">
                                                    <label for="nis" class="col-sm-2">NIS</label>
                                                    <input type="text" inputmode="numeric" id="nis"
                                                        class="form-control" name="nis" placeholder="Masukkan NIS">

                                                </div>
                                                <div class="input-box col-sm-6" style="max-width: 48%">
                                                    <label for="inputNumber" class="">Foto Profil</label>
                                                    <input class="form-control" type="file" id="formFile">
                                                </div>
                                            </div>
                                        </div>


                                    </x-modal>

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
    <script>
        $(document).ready(function() {
            let kelasData =
                @json($kelas);
            let kelasSelect = $("#kelas_id");

            $.each(kelasData, function(index, kelas) {
                kelasSelect.append("<option value='" + kelas.id + "'>" + kelas.nama_kelas + "</option>");
            });
        });
    </script>
    {{-- Select data kelas --}}

    {{-- Modal Tambah Siswa --}}

    <x-modal modalTitle="Tambah Siswa" modalID="addSiswa" btn="Tambah" action="{{ url('siswa') }}"
        method="POST" enctype="multipart/form-data" method2="POST">
        <div class="row mb-3">
            <div class="input-group justify-content-between">
                <div class="input-box col-sm-6" style="max-width: 48%">
                    <label for="name" class="col-sm-2 col-form-label required">Nama</label>
                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                        name="name" placeholder="Masukkan Nama" value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-box col-sm-6" style="max-width: 48%">
                    <label for="username" class="col-sm-2 col-form-label required">Username</label>
                    <input type="text" id="username" class="form-control @error('username') is-invalid @enderror"
                        name="username" placeholder="Masukkan Username" value="{{ old('username') }}">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="input-group col-sm-6 justify-content-between">
                <div class="input-box col-sm-6" style="max-width: 48%">
                    <label for="email" class="col-sm-2 col-form-label required">Email</label>
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" placeholder="Masukkan Email" value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-box col-sm-6" style="max-width: 48%">
                    <label for="password" class="col-sm-2 col-form-label required">Password</label>
                    <input type="password" id="password"
                        class="form-control @error('password') is-invalid @enderror" name="password"
                        placeholder="Masukkan Password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label class="mb-2 required">Kelas</label>
            <div class="col-sm-12">
                <select class="form-select select2AddSiswa @error('kelas_id') is-invalid @enderror " name="kelas_id">
                    <option selected value="">- Pilih kelas -</option>
                    @foreach ($kelas as $kelas)
                        <option value="{{ $kelas->id }}" @if (old('kelas_id') == $kelas->id) selected @endif>
                            {{ $kelas->nama_kelas }}</option>
                    @endforeach
                </select>
                @error('kelas_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="input-group col-sm-6 justify-content-between">
                <div class="input-box col-sm-6" style="max-width: 48%">
                    <label for="nis" class="col-sm-2">NIS</label>
                    <input type="text" inputmode="numeric" id="nis"
                        class="form-control @error('nis') is-invalid @enderror" name="nis"
                        placeholder="Masukkan NIS" value="{{ old('nis') }}">
                    @error('nis')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-box col-sm-6" style="max-width: 48%">
                    <label for="inputNumber" class="">Foto Profil</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
            </div>

        </div>
    </x-modal>

    {{-- Modal Tambah Siswa --}}

    {{-- Modal Error --}}
    @if (session('addSiswa'))
        <script>
            toastr.error("{{ Session::get('addSiswa') }}");
            $(document).ready(function() {
                $('#addSiswa').modal('show');
            });
        </script>
    @endif




    @if (session('updateSiswa'))
        <script>
            swal("Error!", "{{ Session::get('updateSiswa') }}", "error"), {
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
