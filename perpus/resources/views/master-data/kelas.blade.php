<x-layouts.main :title="$title" :mainPage="$main_page" :page="$page">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <h5 class="card-title">Data Kelas</h5>
                        <div class="btn-action">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addKelas">
                                Tambah <span class="fw-semibold">+</span>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto mt-4">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th>
                                        No
                                    </th>
                                    <th class="text-nowrap">Nama Kelas</th>
                                    <th class="text-nowrap">Status</th>
                                    <th data-sortable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-nowrap">{{ $data->nama_kelas }}</td>
                                        <td class="text-nowrap">{{ $data->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                                        <td class="text-nowrap">
                                            <div class="d-flex gap-1">
                                                <a href="{{ url('kelas/delete/' . $data->id) }}"
                                                    class="badge border-danger border" onclick="confirm(event)"><i
                                                        class='bx bxs-trash text-danger'></i></a>
                                                <button type="button" class="badge bg-light border-warning border"
                                                    data-bs-toggle="modal" data-bs-target="#updateKelas"
                                                    data-kelas="{{ $data }}">
                                                    <span class="fw-semibold"><i
                                                            class="bx bxs-edit text-warning"></i></span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>



                                    {{-- modal update --}}

                                    <x-modal modalTitle="Update Kelas" modalID="updateKelas" btn="Update"
                                        action="" method="POST" enctype="" method2="PUT">

                                        <div class="row mb-3">
                                            <div class="input-group justify-content-between">
                                                <div class="input-box col-sm-6" style="max-width: 48%">
                                                    <label for="nama_kelas" class="col-sm-6 mb-2 required">Nama
                                                        Kelas</label>
                                                    <input type="text" id="nama_kelas" class="form-control"
                                                        name="nama_kelas" placeholder="Masukkan Nama">
                                                </div>
                                                <div class="input-box col-sm-6" style="max-width: 48%">
                                                    <label class="mb-2 required">Kelas</label>
                                                    <div class="col-sm-12">
                                                        <select id="status" class="form-select " name="status">
                                                            <option @if (old('status', $data->status) == 1) selected @endif
                                                                value="1">Aktif</option>
                                                            <option @if (old('status', $data->status) == 0) selected @endif
                                                                value="0">Tidak Aktif</option>
                                                        </select>

                                                    </div>
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

    <x-modal modalTitle="Tambah Kelas" modalID="addKelas" btn="Tambah" action="{{ url('kelas') }}" method="POST"
        enctype="" method2="POST">
        <div class="row mb-3">
            <div class="input-group d-flex justify-content-between flex-column flex-sm-row">
                <div class="input-box mb-3" style="max-width: @media('sm') ? '48%' : ''">
                    <label for="nama_kelas" class="col-sm-6 mb-2 required">Nama Kelas</label>
                    <input type="text" id="nama_kelas"
                        class="form-control  @error('nama_kelas') is-invalid @enderror" name="nama_kelas"
                        placeholder="Masukkan Nama" value="{{ old('nama_kelas') }}">
                    @error('nama_kelas')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-box col-sm-6" style="@media('sm') ? 'max-width: 48%' : ''">
                    <label class="mb-2 required">Kelas</label>
                    <div class="col-sm-12">
                        <select id="status" class="form-select @error('status') is-invalid @enderror" name="status">
                            <option selected value="">- Pilih Status -</option>
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </x-modal>


    {{-- Modal Error --}}
    @if (session('addKelas'))
        <script>
            toastr.error("{{ Session::get('addKelas') }}");
            $(document).ready(function() {
                $('#addKelas').modal('show');
            });
        </script>
    @endif


    @if (session('updateKelas'))
        <script>
            swal("Error!", "{{ Session::get('updateKelas') }}", "error"), {
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
