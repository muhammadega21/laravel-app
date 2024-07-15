<x-layouts.main :title="$title" :mainPage="$main_page" :page="$page">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title">Data Buku</h5>
                        <div class="btn-action">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addBuku">
                                Tambah <span class="fw-semibold">+</span>
                            </button>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul</th>
                                    <th class="text-nowrap">ISBN/ISSN</th>
                                    <th class="text-nowrap">ID Rak</th>
                                    <th class="text-nowrap">Nama Rak</th>
                                    <th class="text-nowrap">Jumlah</th>
                                    <th data-sortable="false">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->judul }}</td>
                                        <td class="text-nowrap">{{ $data->isbn }}</td>
                                        <td class="text-nowrap">{{ $data->rak->id_rak }}</td>
                                        <td class="text-nowrap">{{ $data->rak->nama_rak }}</td>
                                        <td class="text-nowrap">{{ $data->jumlah }}</td>
                                        <td class="text-nowrap">
                                            <div class="d-flex gap-1">
                                                <a href="{{ url('buku/' . $data->slug) }}"
                                                    class="badge border-primary border"><i
                                                        class='bx bxs-show text-primary'></i></a>
                                                <a href="{{ url('buku/delete/' . $data->id) }}"
                                                    class="badge border-danger border" onclick="confirm(event)"><i
                                                        class='bx bxs-trash text-danger'></i></a>
                                                <button type="button" class="badge bg-light border-warning border"
                                                    data-bs-toggle="modal" data-bs-target="#updateBuku"
                                                    data-buku="{{ $data }}">
                                                    <span class="fw-semibold"><i
                                                            class="bx bxs-edit text-warning"></i></span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>



                                    {{-- modal update --}}

                                    <x-modal modalTitle="Update Buku" modalID="updateBuku" btn="Update" action=""
                                        method="POST">

                                        <div class="row mb-3">
                                            <div class="input-group justify-content-between">
                                                <div class="input-box col-sm-6" style="max-width: 48%">
                                                    <label for="nama_kelas" class="col-sm-5 mb-2 ">Nama
                                                        Kelas</label>
                                                    <input type="text" id="nama_kelas" class="form-control"
                                                        name="nama_kelas" placeholder="Masukkan Nama"
                                                        value="{{ old('nama_kelas', $data->nama_kelas) }}">
                                                </div>
                                                <div class="input-box col-sm-6" style="max-width: 48%">
                                                    <label class="mb-2">Kelas</label>
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

    <x-modal modalTitle="Tambah Buku" modalID="addBuku" btn="Tambah" action="{{ url('buku') }}" method="POST">
        <div class="row mb-3">
            <div class="input-group justify-content-between">
                <div class="input-box col-sm-6" style="max-width: 48%">
                    <label for="judul" class="col-sm-5 mb-2 required">Judul Buku</label>
                    <input type="text" id="judul" class="form-control @error('judul') is-invalid @enderror"
                        name="judul" placeholder="Masukkan Nama" value="{{ old('judul') }}">
                    @error('judul')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-box col-sm-6" style="max-width: 48%">
                    <label for="isbn" class="col-sm-5 mb-2">ISBN</label>
                    <input type="text" id="isbn" class="form-control @error('isbn') is-invalid @enderror"
                        name="isbn" placeholder="Masukkan Nama" value="{{ old('isbn') }}">
                    @error('isbn')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="input-group justify-content-between mt-3">
                <div class="input-box col-sm-6" style="max-width: 48%">
                    <label for="jumlah" class="col-sm-5 mb-2 required">Jumlah</label>
                    <input type="text" id="jumlah" class="form-control @error('jumlah') is-invalid @enderror"
                        name="jumlah" placeholder="Masukkan Nama" value="{{ old('jumlah') }}">
                    @error('jumlah')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-box col-sm-6" style="max-width: 48%">
                    <label for="formFile" class="col-sm-6 mb-2">Sampul Buku</label>
                    <input class="form-control" type="file" id="formFile">
                </div>
            </div>
            <div class="input-group justify-content-between mt-3">
                <div class="input-box col-sm-12">
                    <label class="mb-2 required">Rak</label>
                    <select class="form-select
                        @error('rak_id') is-invalid @enderror"
                        name="rak_id">
                        <option selected value="">- Pilih Rak -</option>
                        @foreach ($rak as $rak)
                            <option value="{{ $rak->id }}" @if (old('rak_id') == $rak->id) selected @endif>
                                {{ $rak->nama_rak }}</option>
                        @endforeach
                    </select>
                    @error('rak_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="input-group justify-content-between mt-3">
                <div class="input-box col-sm-6" style="max-width: 48%">
                    <label for="bahasa" class="col-sm-6 mb-2">Bahasa Buku</label>
                    <input type="text" id="bahasa" class="form-control @error('bahasa') is-invalid @enderror"
                        name="bahasa" placeholder="Masukkan Nama" value="{{ old('bahasa') }}">
                    @error('bahasa')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-box col-sm-6" style="max-width: 48%">
                    <label for="halaman" class="col-sm-5 mb-2">Halaman</label>
                    <input type="text" id="halaman" class="form-control @error('halaman') is-invalid @enderror"
                        name="halaman" placeholder="Masukkan Nama" value="{{ old('halaman') }}">
                    @error('halaman')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-group justify-content-between mt-3">
                    <div class="input-box col-sm-6" style="max-width: 48%">
                        <label for="pengarang" class="col-sm-5 mb-2">Pengarang</label>
                        <input type="text" id="pengarang"
                            class="form-control @error('pengarang') is-invalid @enderror" name="pengarang"
                            placeholder="Masukkan Nama" value="{{ old('pengarang') }}">
                        @error('pengarang')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="input-box col-sm-6" style="max-width: 48%">
                        <label for="penerbit" class="col-sm-5 mb-2">Penerbit</label>
                        <input type="text" id="penerbit"
                            class="form-control @error('penerbit') is-invalid @enderror" name="penerbit"
                            placeholder="Masukkan Nama" value="{{ old('penerbit') }}">
                        @error('penerbit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="input-group justify-content-between mt-3">
                    <div class="input-box col-sm-6" style="max-width: 48%">
                        <label for="tahun_terbit" class="col-sm-6 mb-2">Tahun Terbit</label>
                        <input type="text" id="tahun_terbit"
                            class="form-control @error('tahun_terbit') is-invalid @enderror" name="tahun_terbit"
                            placeholder="Masukkan Nama" value="{{ old('tahun_terbit') }}">
                        @error('tahun_terbit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="input-box col-sm-6" style="max-width: 48%">
                        <label for="tempat_terbit" class="col-sm-6 mb-2">Tempat Terbit</label>
                        <input type="text" id="tempat_terbit"
                            class="form-control @error('tempat_terbit') is-invalid @enderror" name="tempat_terbit"
                            placeholder="Masukkan Nama" value="{{ old('tempat_terbit') }}">
                        @error('tempat_terbit')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
    </x-modal>


    {{-- Modal Error --}}
    @if (session('addBuku'))
        <script>
            toastr.error("{{ Session::get('addBuku') }}");
            $(document).ready(function() {
                $('#addBuku').modal('show');
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
