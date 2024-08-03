<x-layouts.main :title="$title" :mainPage="$main_page" :page="$page">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <h5 class="card-title">Data Peminjaman</h5>
                        @canany(['admin', 'petugas'])
                            <div class="btn-action">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addPeminjaman">
                                    Tambah <span class="fw-semibold">+</span>
                                </button>
                            </div>
                        @endcanany
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
                                    @canany(['admin', 'petugas'])
                                        <th data-sortable="false">Action</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-nowrap">
                                            {{ $data->id_pinjam }}</td>
                                        <td><span class="trucated-text">{{ $data->siswa->name }}</span></td>
                                        <td>
                                            <a href="{{ url('daftar_buku/' . $data->buku->slug) }}"
                                                class="trucated-text">{{ $data->buku->judul }}</a>
                                        </td>
                                        <td>{{ $data->tgl_pinjam }}</td>
                                        <td>
                                            {{ $data->tgl_kembali }}</td>
                                        <td>{{ $data->petugas->name }}</td>
                                        @canany(['admin', 'petugas'])
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ url('peminjaman/delete/' . $data->id) }}"
                                                        class="badge border-danger border" onclick="confirm(event)"><i
                                                            class='bx bxs-trash text-danger'></i></a>
                                                    <button type="button" class="badge bg-light border-warning border"
                                                        data-bs-toggle="modal" data-bs-target="#updatePeminjaman"
                                                        data-peminjaman="{{ $data }}">
                                                        <span class="fw-semibold"><i
                                                                class="bx bxs-edit text-warning"></i></span>
                                                    </button>
                                                    <a href="{{ url('peminjaman/kembali/' . $data->id_pinjam) }}"
                                                        class="badge {{ !$data->status ? 'border-primary' : 'border-success' }} border"
                                                        @if (!$data->status) onclick="confirmKembali(event)" @else onclick="confirmComplete(event)" @endif><i
                                                            class='{{ !$data->status ? 'bx bx-repeat text-primary' : 'bx bx-check text-success' }}  fw-semibold'></i></a>
                                                </div>
                                            </td>
                                        @endcanany
                                    </tr>



                                    {{-- modal update --}}


                                    <x-modal modalTitle="Update Siswa" modalID="updatePeminjaman" btn="Update"
                                        action="" method="POST" enctype="" method2="PUT">

                                        <div class="row mb-3">
                                            <label class="mb-2 required">Siswa</label>
                                            <div class="col-sm-12">
                                                <select class="" name="siswa_id" id="siswa_id">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label class="mb-2 required">Buku</label>
                                            <div class="col-sm-12">
                                                <select class=" " name="buku_id" id="buku_id">
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="input-group justify-content-between">
                                                <div class="input-box col-sm-6" style="max-width: 48%">
                                                    <label for="tgl_pinjam" class="col-form-label required">Tanggal
                                                        Pinjam</label>
                                                    <input type="date" id="tgl_pinjam" class="form-control "
                                                        name="tgl_pinjam" placeholder="Masukkan Nama">
                                                </div>
                                                <div class="input-box col-sm-6" style="max-width: 48%">
                                                    <label for="tgl_kembali" class="col-form-label required">Tanggal
                                                        Kembali</label>
                                                    <input type="date" id="tgl_kembali" class="form-control "
                                                        name="tgl_kembali" placeholder="Masukkan Nama">
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

    @canany(['admin', 'petugas'])
        {{-- Select data buku --}}
        <script>
            $(document).ready(function() {
                let dataBuku = @json($buku);
                let bukuSelect = $("#buku_id");

                $.each(dataBuku, function(index, buku) {
                    bukuSelect.append("<option value='" + buku.id + "'>" + buku.judul + "</option>");
                });

            });
        </script>
        {{-- Select data buku --}}

        {{-- Select data siswa --}}
        <script>
            $(document).ready(function() {
                let dataSiswa = @json($siswa);
                let siswaSelect = $("#siswa_id");

                $.each(dataSiswa, function(index, siswa) {
                    siswaSelect.append("<option value='" + siswa.id + "'>" + siswa.name + "</option>");
                });

            });
        </script>
        {{-- Select data siswa --}}
    @endcanany

    {{-- Modal Tambah Peminjaman --}}

    <x-modal modalTitle="Tambah Peminjaman" modalID="addPeminjaman" btn="Tambah" action="{{ url('peminjaman') }}"
        method="POST" enctype="" method2="POST">
        <div class="row mb-3">
            <label class="mb-2 required">Siswa</label>
            <div class="col-sm-12 ">
                <select class="form-select select2AddSiswaPeminjaman @error('siswa_id') is-invalid @enderror "
                    name="siswa_id">
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
            <div class="col-sm-12 ">
                <select class=" form-select select2AddBukuPeminjaman @error('buku_id') is-invalid @enderror "
                    name="buku_id">
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
                    <input type="date" id="tgl_pinjam"
                        class="form-control @error('tgl_pinjam') is-invalid @enderror" name="tgl_pinjam"
                        placeholder="Masukkan Nama" value="{{ old('tgl_pinjam', date('Y-m-d')) }}">
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
