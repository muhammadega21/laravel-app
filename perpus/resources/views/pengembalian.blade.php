<x-layouts.main :title="$title" :mainPage="$main_page" :page="$page">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <h5 class="card-title">Data Pengembalian</h5>

                    </div>
                    <div class="overflow-x-auto">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th class="text-nowrap">ID Kembali</th>
                                    <th class="text-nowrap">Nama Siswa</th>
                                    <th class="text-nowrap">Judul Buku</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Petugas</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-nowrap">
                                            {{ $data->id_kembali }}</td>
                                        <td><span class="trucated-text">{{ $data->siswa->name }}</span></td>
                                        <td>
                                            <a href="{{ url('daftar_buku/' . $data->buku->slug) }}"
                                                class="trucated-text">{{ $data->buku->judul }}</a>
                                        </td>
                                        <td>
                                            {{ $data->tgl_kembali }}</td>
                                        <td>{{ $data->petugas->name }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.main>
