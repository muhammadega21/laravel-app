<x-layouts.main :title="$title" :mainPage="$main_page" :page="$page">
    <div class="col-12">
        <div class="card top-selling overflow-auto">

            <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <li class="dropdown-header text-start">
                        <h6>Filter</h6>
                    </li>

                    <li><a class="dropdown-item" href="#">Today</a></li>
                    <li><a class="dropdown-item" href="#">This Month</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
            </div>

            <div class="card-body pb-0">
                <h5 class="card-title">Top Selling <span>| Today</span></h5>

                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Sampul</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Rak</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr>
                                <td class="fw-bold" scope="row">{{ $loop->iteration }}</a>
                                    </th>
                                <th><a href="{{ url('daftar_buku/' . $data->slug) }}"><img
                                            src="{{ asset('img/' . $data->image) }}" alt="{{ $data->judul }}"></a>
                                </th>
                                <td class="fw-semibold"><a
                                        href="{{ url('daftar_buku/' . $data->slug) }}">{{ $data->judul }}</a>
                                </td>
                                <td>{{ $data->jumlah }}</td>
                                <td>{{ $data->rak->nama_rak }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>
</x-layouts.main>
