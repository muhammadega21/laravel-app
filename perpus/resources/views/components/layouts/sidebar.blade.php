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

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#master-data" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Master Data</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="master-data" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ url('petugas') }}">
                        <i class="bi bi-circle"></i><span>Data Petugas</span>
                    </a>
                </li>
            </ul>
            <ul id="master-data" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Data Siswa</span>
                    </a>
                </li>
            </ul>
            <ul id="master-data" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Data Kelas</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Master Data -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#katalog-buku" data-bs-toggle="collapse" href="#">
                <i class="bi bi-book"></i><span>Katalog Buku</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="katalog-buku" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Data Buku</span>
                    </a>
                </li>
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Data Pengarang</span>
                    </a>
                </li>
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Data Penerbit</span>
                    </a>
                </li>
                <li>
                    <a href="components-alerts.html">
                        <i class="bi bi-circle"></i><span>Data Rak</span>
                    </a>
                </li>
            </ul>
        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-clipboard-minus"></i>
                <span>Data peminjaman</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-repeat"></i>
                <span>Data Pengembalian</span>
            </a>
        </li>
        </li><!-- End Katalog Buku -->

        <li class="nav-heading">Setting</li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>Profile</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Setting</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="pages-login.html">
                <i class="bi bi-box-arrow-in-right"></i>
                <span>Sign Out</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->
