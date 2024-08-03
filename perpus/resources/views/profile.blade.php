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

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                Profile</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab"
                                data-bs-target="#profile-change-password">Change Password</button>
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
                            @if ($data->user->role == 3)
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label fw-semibold">Kelas</div>
                                    <div class="col-lg-9 col-md-8">: {{ $data->kelas->nama_kelas }}</div>
                                </div>
                            @endif

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

                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                            <!-- Profile Edit Form -->
                            <form action="{{ url('profile/update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                        Image</label>
                                    <div class="col-md-8 col-lg-9">
                                        <img id="profilePreview"
                                            src="{{ asset(!$data->image ? 'img/user.png' : 'storage/' . $data->image) }}"
                                            width="100" alt="Profile">
                                        <div class="pt-2">
                                            <label class="btn btn-primary btn-sm" for="inputImage"><i
                                                    class="bi bi-upload"></i></label>
                                            <input type="hidden" name="oldImage" value="{{ $data->image }}">
                                            <input type="file"
                                                class="form-control @error('image') is-invalid @enderror" hidden
                                                name="image" id="inputImage" onchange="previewImage()">
                                            <a href="{{ url('profile/delete-image') }}" class="btn btn-danger btn-sm"
                                                title="Remove my profile image" onclick="confirmDeleteImage(event)"><i
                                                    class="bi bi-trash"></i></a>
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="name" type="text"
                                            class="form-control  @error('name') is-invalid @enderror" id="name"
                                            value="{{ old('name', $data->name) }}">
                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="username" type="text"
                                            class="form-control @error('username') is-invalid @enderror"
                                            id="username" value="{{ old('username', $data->username) }}">
                                        @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" id="email"
                                            value="{{ old('email', $data->user->email) }}">
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-4 col-lg-3 col-form-label">Jenis Kelamin</label>
                                    <div class="col-md-8 col-lg-9">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="L" value="L"
                                                {{ $data->jenis_kelamin == 'L' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="L">
                                                Laki - Laki
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="jenis_kelamin"
                                                id="P" value="P"
                                                {{ $data->jenis_kelamin == 'P' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="P">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="no_telp" class="col-md-4 col-lg-3 col-form-label">No Telp</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="no_telp" type="text"
                                            class="form-control @error('no_telp') is-invalid @enderror" id="no_telp"
                                            value="{{ old('no_telp', $data->no_telp) }}">
                                        @error('no_telp')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                                    <div class="col-md-8 col-lg-9">
                                        <input name="alamat" type="text"
                                            class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                            value="{{ old('alamat', $data->alamat) }}">
                                        @error('alamat')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>



                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form><!-- End Profile Edit Form -->

                        </div>

                        <div class="tab-pane fade pt-3" id="profile-change-password">
                            <!-- Change Password Form -->
                            <form method="post" action="{{ url('profile/change_password') }}">
                                @csrf
                                @method('PUT')

                                <div class="row mb-3">
                                    <label for="currentPassword" class="col-md-4 col-lg-4 col-form-label">Current
                                        Password</label>
                                    <div class="col-md-8 col-lg-8">
                                        <input name="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            id="currentPassword" placeholder="Masukkan Password">
                                        @error('password')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="newPassword" class="col-md-4 col-lg-4 col-form-label">New
                                        Password</label>
                                    <div class="col-md-8 col-lg-8">
                                        <input name="newpassword" type="password"
                                            class="form-control @error('newpassword') is-invalid @enderror"
                                            id="newPassword" placeholder="Masukkan Password Baru">
                                        @error('newpassword')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password_confirm" class="col-md-4 col-lg-4 col-form-label">Confirm
                                        Password</label>
                                    <div class="col-md-8 col-lg-8">
                                        <input name="password_confirm" type="password"
                                            class="form-control @error('password_confirm') is-invalid @enderror"
                                            id="password_confirm" placeholder="Ulangi Password Baru">
                                        @error('password_confirm')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
                                </div>
                            </form><!-- End Change Password Form -->

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>

    {{-- Alert  --}}
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
    @elseif (Session::has('errorToast'))
        <script>
            toastr.error("{{ Session::get('errorToast') }}");
        </script>
    @endif
</x-layouts.main>
