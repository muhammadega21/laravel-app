<x-layouts.main :title="$title" :mainPage="$main_page" :page="$page">
    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                    <div class="profile-img mb-3">
                        <img src="{{ asset(!$data->image ? 'img/user.png' : 'storage/' . $data->image) }}" alt="Profile">
                    </div>
                    <h2 class="text-center">{{ $data->name }}</h2>
                    <h4 class="text-secondary fs-5">
                        {{ $data->user->role == 1 ? 'Admin' : ($data->user->role == 2 ? 'Petugas' : 'Siswa') }}</h4>
                </div>
            </div>

        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#profile-overview">Profile</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview mt-3" id="profile-overview">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-semibold ">Nama</div>
                                <div class="col-lg-9 col-md-8">: {{ $data->name }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-semibold">Username</div>
                                <div class="col-lg-9 col-md-8">: {{ $data->username }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-semibold">Email</div>
                                <div class="col-lg-9 col-md-8">: {{ $data->user->email }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-semibold">
                                    {{ $data->user->role == 1 ? 'ID Petugas' : 'ID Siswa' }}</div>
                                <div class="col-lg-9 col-md-8">:
                                    {{ $data->user->role == 1 ? $data->id_petugas : $data->id_siswa }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-semibold">Kelas</div>
                                <div class="col-lg-9 col-md-8">: {{ $data->kelas->nama_kelas }}</div>
                            </div>

                            @if ($data->user->role == 2)
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label fw-semibold">NIS</div>
                                    <div class="col-lg-9 col-md-8">: {{ $data->nis }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label fw-semibold">Kelas</div>
                                    <div class="col-lg-9 col-md-8">: {{ $data->kelas->nama_kelas }}</div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-semibold">No Telp</div>
                                <div class="col-lg-9 col-md-8">: {{ $data->no_telp }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-semibold">Jenis Kelamin</div>
                                <div class="col-lg-9 col-md-8">
                                    :
                                    {{ $data->jenis_kelamin == 'P' ? 'Perempuan' : ($data->jenis_kelamin == 'L' ? 'Laki-Laki' : '') }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label fw-semibold">Alamat</div>
                                <div class="col-lg-9 col-md-8">: {{ $data->alamat }}</div>
                            </div>

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</x-layouts.main>
