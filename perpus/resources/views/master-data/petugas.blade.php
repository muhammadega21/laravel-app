<x-layouts.main :title="$title" :mainPage="$main_page" :page="$page">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <h5 class="card-title">Data Petugas</h5>
                        <div class="btn-action">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addPetugas">
                                Tambah <span class="fw-semibold">+</span>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th class="text-nowrap">ID Petugas</th>
                                    <th class="text-nowrap">Nama</th>
                                    <th class="text-nowrap">Email</th>
                                    <th class="text-nowrap">Role</th>
                                    <th data-sortable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-nowrap">{{ $data->id_petugas }}</td>
                                        <td class="text-nowrap">{{ $data->name }}</td>
                                        <td class="text-nowrap">{{ $data->user->email }}</td>
                                        <td class="text-nowrap">{{ $data->user->role == 1 ? 'Admin' : 'Petugas' }}</td>
                                        <td class="text-nowrap">
                                            <div class="d-fle gap-1">
                                                <a href="{{ url('petugas/delete/' . $data->id_petugas) }}"
                                                    class="badge border-danger border" onclick="confirm(event)"><i
                                                        class='bx bxs-trash text-danger'></i></a>
                                                <button type="button" class="badge bg-light border-warning border"
                                                    data-bs-toggle="modal" data-bs-target="#updatePetugas"
                                                    data-petugas="{{ $data }}">
                                                    <span class="fw-semibold"><i
                                                            class="bx bxs-edit text-warning"></i></span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>



                                    {{-- modal update --}}

                                    <x-modal modalTitle="Update Petugas" modalID="updatePetugas" btn="Update"
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
                                                <div class="input-box col-sm-6" style="max-width: 48% ">
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
                                            <label for="inputNumber" class="">Foto Profil</label>
                                            <div class="col-sm-12 mt-2">
                                                <input class="form-control" type="file" id="formFile">
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

    <x-modal modalTitle="Tambah Petugas" modalID="addPetugas" btn="Tambah" action="{{ url('petugas') }}"
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
            <label for="inputNumber" class="">Foto Profil</label>
            <div class="col-sm-12 mt-2">
                <input class="form-control" type="file" id="formFile">
            </div>
        </div>
    </x-modal>


    {{-- Modal Error --}}
    @if (session('addPetugas'))
        <script>
            toastr.error("{{ Session::get('addPetugas') }}");
            $(document).ready(function() {
                $('#addPetugas').modal('show');
            });
        </script>
    @endif


    @if (session('updatePetugas'))
        <script>
            swal("Error!", "{{ Session::get('updatePetugas') }}", "error"), {
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
