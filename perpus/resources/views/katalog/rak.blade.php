<x-layouts.main :title="$title" :mainPage="$main_page" :page="$page">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <h5 class="card-title">Data Rak</h5>
                        <div class="btn-action">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRak">
                                Tambah <span class="fw-semibold">+</span>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="text-nowrap">ID Rak</th>
                                    <th class="text-nowrap">Nama Rak</th>
                                    <th data-sortable="false" class="text-nowrap">Keterangan</th>
                                    <th data-sortable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->id_rak }}</td>
                                        <td class="text-nowrap">{{ $data->nama_rak }}</td>
                                        <td>{{ $data->keterangan }}</td>
                                        <td class="text-nowrap">
                                            <div class="d-flex gap-1">
                                                <a href="{{ url('rak/delete/' . $data->id_rak) }}"
                                                    class="badge border-danger border" onclick="confirm(event)"><i
                                                        class='bx bxs-trash text-danger'></i></a>
                                                <button type="button" class="badge bg-light border-warning border"
                                                    data-bs-toggle="modal" data-bs-target="#updateRak"
                                                    data-rak="{{ $data }}">
                                                    <span class="fw-semibold"><i
                                                            class="bx bxs-edit text-warning"></i></span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>



                                    {{-- modal update --}}

                                    <x-modal modalTitle="Update Buku" modalID="updateRak" btn="Update" action=""
                                        method="POST" enctype="" method2="PUT">

                                        <div class="row mb-3">
                                            <label for="nama_rak" class="col-sm-5 mb-2 required">Nama Rak</label>
                                            <div class="input-box col-sm-12">
                                                <input type="text" id="nama_rak" class="form-control "
                                                    name="nama_rak" placeholder="Masukkan Nama Rak">

                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="keterangan" class="col-sm-5 mb-2">Keterangan</label>
                                            <div class=" b-3">
                                                <textarea name="keterangan" id="keterangan" class="form-control " placeholder="Masukkan Keterangan Rak"
                                                    id="floatingTextarea" style="height: 100px;"></textarea>
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

    <x-modal modalTitle="Tambah Rak" modalID="addRak" btn="Tambah" action="{{ url('rak') }}" method="POST"
        enctype="" method2="POST">
        <div class="row mb-3">
            <label for="nama_rak" class="col-sm-5 mb-2 required">Nama Rak</label>
            <div class="input-box col-sm-12">
                <input type="text" id="nama_rak" class="form-control @error('nama_rak') is-invalid @enderror"
                    name="nama_rak" placeholder="Masukkan Nama Rak" value="{{ old('nama_rak') }}">
                @error('nama_rak')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="keterangan" class="col-sm-5 mb-2">Keterangan</label>
            <div class=" b-3">
                <textarea name="keterangan" id="keterangan" class="form-control @error('keterangan') is-invalid @enderror"
                    placeholder="Masukkan Keterangan Rak" id="floatingTextarea" style="height: 100px;">{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </x-modal>


    {{-- Modal Error --}}
    @if (session('addRak'))
        <script>
            toastr.error("{{ Session::get('addRak') }}");
            $(document).ready(function() {
                $('#addRak').modal('show');
            });
        </script>
    @endif


    @if (session('updateRak'))
        <script>
            swal("Error!", "{{ Session::get('updateRak') }}", "error"), {
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
