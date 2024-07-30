<x-layouts.main :title="$title" :mainPage="$main_page" :page="$page">
    <div class="row">
        <div class="col-lg">
            <div class="card">
                <div class="card-body">
                    <div class="overflow-x-auto mt-4">
                        <div class="form-input d-flex justify-content-end">
                            <input type="text" id="searchInput" placeholder="Search...">
                        </div>
                        <table class="table table-bordered  mt-4" id="dataTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th data-sortable="false" class="text-nowrap">Sampul</th>
                                    <th class="text-nowrap">Judul</th>
                                    <th data-sortable="false" class="text-nowrap">Rak</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td class="align-middle">{{ $loop->iteration }}</td>

                                        <td>
                                            <a href="{{ url('daftar_buku/' . $data->slug) }}">
                                                <img width="50"
                                                    src="{{ asset(!$data->image ? 'img/buku.png' : 'storage/' . $data->image) }}"
                                                    alt="{{ $data->judul }}" class="cover border">
                                            </a>
                                        </td>
                                        <td class="align-middle">
                                            <a href="{{ url('daftar_buku/' . $data->slug) }}"
                                                class="text-primary fw-semibold trucated-text">{{ $data->judul }}</a>
                                        </td>
                                        <td class="align-middle text-nowrap">{{ $data->rak->nama_rak }}</td>
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
