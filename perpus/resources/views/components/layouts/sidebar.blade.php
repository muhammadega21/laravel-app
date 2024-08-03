<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Pages</li>
        @canany(['admin', 'petugas'])
            <li class="nav-item">
                <a class="nav-link  {{ Request::is(['petugas', 'siswa*', 'kelas']) ? 'active' : 'collapsed' }}"
                    data-bs-target="#master-data" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="master-data"
                    class="nav-content collapse {{ Request::is(['petugas', 'siswa*', 'kelas']) ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    @can('bigAdmin')
                        <li>
                            <a href="{{ url('petugas') }}" class="{{ Request::is('petugas') ? 'active' : '' }}">
                                <i class="bi bi-circle"></i><span>Data Petugas</span>
                            </a>
                        </li>
                    @endcan
                    <li>
                        <a href="{{ url('siswa') }}" class="{{ Request::is('siswa*') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Data Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('kelas') }}" class="{{ Request::is('kelas') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Data Kelas</span>
                        </a>
                    </li>
                </ul>

            </li><!-- End Master Data -->

            <li class="nav-item">
                <a class="nav-link {{ Request::is(['buku', 'pengarang', 'penerbit', 'rak']) ? 'active' : 'collapsed' }}"
                    data-bs-target="#katalog-buku" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-card-list"></i><span>Katalog Buku</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="katalog-buku"
                    class="nav-content collapse {{ Request::is(['buku', 'pengarang', 'penerbit', 'rak']) ? 'show' : '' }}"
                    data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ url('buku') }}" class="{{ Request::is('buku') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Data Buku</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('rak') }}" class="{{ Request::is('rak') ? 'active' : '' }}">
                            <i class="bi bi-circle"></i><span>Data Rak</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcanany
        <li class="nav-item">
            <a class="nav-link collapsed {{ Request::is('daftar_buku*') ? 'active' : '' }}"
                href="{{ url('daftar_buku') }}">
                <i class="bi bi-book"></i>
                <span>Daftar Buku</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed {{ Request::is('peminjaman') ? 'active' : '' }}"
                href="{{ url('peminjaman') }}">
                <i class="bi bi-clipboard-minus"></i>
                <span>Data peminjaman</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed {{ Request::is('pengembalian') ? 'active' : '' }}"
                href="{{ url('pengembalian') }}">
                <i class="bi bi-repeat"></i>
                <span>Data Pengembalian</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed {{ Request::is('denda') ? 'active' : '' }}" href="{{ url('denda') }}">
                <i class="bi bi-exclamation-circle"></i>
                <span>Data Denda</span>
            </a>
        </li><!-- End Katalog Buku -->


        <li class="nav-heading">Setting</li>

        <li class="nav-item">
            <a class="nav-link collapsed {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{ url('/logout') }}" onclick="confirmLogout(event)">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Sign Out</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->
