<x-layouts.main :title="$title" :mainPage="$main_page" :page="$page">
    <div class="mb-4 d-flex justify-content-end" style="padding-right: 2.2rem">
        <a href="{{ url('daftar_buku') }}" class="btn btn-primary">Kembali</a>
    </div>
    <div class="row">
        <div class="col-xl-4">

            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center text-center">

                    <img src="{{ asset(!$buku->image ? 'img/buku.png' : 'storage/' . $buku->image) }}"
                        alt="{{ $buku->judul }}" class="cover border" width="75%">
                    <h2 class="mt-3 px-3 fs-3 fw-semibold">{{ $buku->judul }}</h2>
                </div>
            </div>

        </div>

        <div class="col-xl-8">

            <div class="card">
                <div class="card-body pt-3">
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Deskripsi Buku</h5>
                            <p class="small fst-italic">{{ $buku->sinopsis }}</p>

                            <h5 class="card-title">Profile Details</h5>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Judul</div>
                                <div class="col-lg-9 col-md-8">: {{ $buku->judul }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">ISBN</div>
                                <div class="col-lg-9 col-md-8">: {{ $buku->isbn }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Jumlah</div>
                                <div class="col-lg-9 col-md-8">: {{ $buku->jumlah }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Rak</div>
                                <div class="col-lg-9 col-md-8">: {{ $buku->rak->nama_rak }}</div>
                            </div>


                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Pengarang</div>
                                <div class="col-lg-9 col-md-8">: {{ $buku->pengarang }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Penerbit</div>
                                <div class="col-lg-9 col-md-8">: {{ $buku->penerbit }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Tahun Terbit</div>
                                <div class="col-lg-9 col-md-8">: {{ $buku->tahun_terbit }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Tempat Terbit</div>
                                <div class="col-lg-9 col-md-8">: {{ $buku->tempat_terbit }}</div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Bahasa</div>
                                <div class="col-lg-9 col-md-8">: {{ $buku->bahasa }}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Halaman</div>
                                <div class="col-lg-9 col-md-8">: {{ $buku->halaman }}</div>
                            </div>

                        </div>

                    </div><!-- End Bordered Tabs -->

                </div>
            </div>

        </div>
    </div>
</x-layouts.main>
