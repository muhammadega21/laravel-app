<x-layouts.main :title="$title" :mainPage="$main_page" :page="$page">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <h5 class="card-title">Data Denda</h5>
                        <div class="btn-action">
                            @canany(['admin', 'petugas'])
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addDenda">
                                    Tambah <span class="fw-semibold">+</span>
                                </button>
                            @endcanany
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="text-nowrap">ID Denda</th>
                                    <th class="text-nowrap">ID Kembali</th>
                                    <th class="text-nowrap">Nama Siswa</th>
                                    <th class="text-nowrap">Buku</th>
                                    <th class="text-nowrap">Denda</th>
                                    <th class="text-nowrap">Biaya Denda</th>
                                    <th class="text-nowrap">Status</th>
                                    @canany(['admin', 'petugas'])
                                        <th data-sortable="false">Action</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $data->id_denda }}</td>
                                        <td>{{ $data->pengembalian->id_kembali }}</td>
                                        <td>{{ $data->siswa->name }}</td>
                                        <td><a href="{{ url('daftar_buku/' . $data->buku->slug) }}"
                                                class="trucated-text">{{ $data->buku->judul }}</a>
                                        </td>
                                        <td>{{ $data->nama_denda }}</td>
                                        <td>Rp {{ number_format($data->biaya_denda, 2, ',', '.') }}</td>
                                        <td class="{{ !$data->status ? 'text-danger' : 'text-success' }}">
                                            {{ !$data->status ? 'Belum Bayar' : 'Lunas' }}</td>
                                        @canany(['admin', 'petugas'])
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ url('denda/delete/' . $data->id_denda) }}"
                                                        class="badge border-danger border" onclick="confirm(event)"><i
                                                            class='bx bxs-trash text-danger'></i></a>
                                                    <button type="button" class="badge bg-light border-warning border"
                                                        data-bs-toggle="modal" data-bs-target="#updateDenda"
                                                        data-denda="{{ $data }}">
                                                        <span class="fw-semibold"><i
                                                                class="bx bxs-edit text-warning"></i></span>
                                                    </button>
                                                    <a href="{{ url('denda/bayar/' . $data->id_denda) }}"
                                                        class="badge border-success border"
                                                        @if (!$data->status) onclick="confirmBayar(event)" @else onclick="dendaComplete(event)" @endif><i
                                                            class='bx bx-dollar text-success'></i></a>
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>



                                    {{-- modal update --}}

                                    <x-modal modalTitle="Update Siswa" modalID="updateDenda" btn="Update"
                                        action="" method="POST" enctype="" method2="PUT">
                                        <div class="row mb-3">
                                            <label class="mb-2 required">ID Pengembalian</label>
                                            <div class="col-sm-12">
                                                <select class="form-select" name="pengembalian_id" id="pengembalian_id">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="input-group justify-content-between">
                                                <div class="input-box col-sm-6" style="max-width: 48%">
                                                    <label for="nama_denda"
                                                        class="col-sm-6 col-form-label required">Nama Denda</label>
                                                    <input type="text" id="nama_denda" class="form-control "
                                                        name="nama_denda" placeholder="Masukkan Nama Denda">
                                                </div>
                                                <div class="input-box col-sm-6" style="max-width: 48%">
                                                    <label for="biaya_denda"
                                                        class="col-sm-6 col-form-label required">Biaya Denda</label>
                                                    <input type="text" inputmode="numeric" id="biaya_denda"
                                                        class="form-control formatHarga" name="biaya_denda"
                                                        placeholder="Masukkan Biaya Denda">
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

    {{-- Modal Tambah Denda --}}

    <x-modal modalTitle="Tambah Denda" modalID="addDenda" btn="Tambah" action="{{ url('denda') }}" method="POST"
        enctype="" method2="POST">
        <div class="row mb-3">
            <label class="mb-2 required">ID Pengembalian</label>
            <div class="col-sm-12">
                <select class="form-select select2AddIdPengembalian @error('pengembalian_id') is-invalid @enderror "
                    name="pengembalian_id">
                    <option selected value="">- Pilih ID Pengembalian -</option>
                    @foreach ($pengembalian as $pengembalian)
                        <option value="{{ $pengembalian->id }}" @if (old('pengembalian_id') == $pengembalian->id) selected @endif>
                            {{ $pengembalian->id_kembali }} - {{ $pengembalian->siswa->name }}</option>
                    @endforeach
                </select>
                @error('pengembalian_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="input-group justify-content-between">
                <div class="input-box col-sm-6" style="max-width: 48%">
                    <label for="nama_denda" class="col-sm-6 col-form-label required">Nama Denda</label>
                    <input type="text" id="nama_denda" class="form-control @error('nama_denda') is-invalid @enderror"
                        name="nama_denda" placeholder="Masukkan Nama Denda" value="{{ old('nama_denda') }}">
                    @error('nama_denda')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="input-box col-sm-6" style="max-width: 48%">
                    <label for="biaya_denda" class="col-sm-6 col-form-label required">Biaya Denda</label>
                    <input type="text" inputmode="numeric" id="biaya_denda"
                        class="form-control formatHarga @error('biaya_denda') is-invalid @enderror" name="biaya_denda"
                        placeholder="Masukkan Biaya Denda" value="{{ old('biaya_denda') }}">
                    @error('biaya_denda')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
    </x-modal>

    {{-- Modal Tambah Denda --}}

    {{-- Modal Error --}}
    @if (session('addDenda'))
        <script>
            toastr.error("{{ Session::get('addDenda') }}");
            $(document).ready(function() {
                $('#addDenda').modal('show');
            });
        </script>
    @endif




    @if (session('updateDenda'))
        <script>
            swal("Error!", "{{ Session::get('updateDenda') }}", "error"), {
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
