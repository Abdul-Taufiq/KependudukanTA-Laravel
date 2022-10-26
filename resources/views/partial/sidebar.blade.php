{{-- body --}}
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
                <div class="sidebar-brand-icon">
                    <img class="rounded-circle" src="{{ asset('style/img/logo.png') }}" alt="logo" width="60" >
                </div>
                <div class="sidebar-brand-text mx-3">Desa Ngilen</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request() -> is('home') ? 'active' : '' }}" >
                <a class="nav-link" href="/home">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    utama
                </div>

{{-- hak AKSES KADES --}}
@if (auth()->user()->level=="KADES")

        <!-- Nav Item - Pages Kependudukan Menu -->
        <li class="nav-item {{ request() -> is('penduduk*', 'kk*', 'kelahiran*', 'kematian*', 'pindah*', 'datang*') ? 'active' : ''}}">
            <a class="nav-link {{ request() -> is('penduduk*', 'kk*', 'kelahiran*', 'kematian*', 'pindah*', 'datang*') ? 'aria-expanded= "true"' : 'collapsed'}}"href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-folder-open" aria-hidden="true"></i>
                <span>Data Kependudukan</span>
            </a>
            <div id="collapseTwo" class="collapse {{ request() -> is('penduduk*', 'kk*', 'kelahiran*', 'kematian*', 'pindah*', 'datang*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menampilkan Data:</h6>
                    <a class="collapse-item {{ Request::is('penduduk*') ? 'active' : '' }}" href="/penduduk">Data Penduduk</a>
                    <a class="collapse-item {{ Request::is('kk*') ? 'active' : '' }}" href="/kk">Data Kartu Keluarga</a>
                    <a class="collapse-item {{ Request::is('kelahiran*') ? 'active' : '' }}" href="/kelahiran">Data Kelahiran</a>
                    <a class="collapse-item {{ Request::is('kematian*') ? 'active' : '' }}" href="/kematian">Data Kematian</a>
                    <a class="collapse-item {{ Request::is('pindah*') ? 'active' : '' }}" href="/pindah">Data Pindah</a>
                    <a class="collapse-item {{ Request::is('datang*') ? 'active' : '' }}" href="/datang">Data Datang</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Tambah data Menu -->
        <li class="nav-item  {{ request() -> is('kades*', 'sekdes*', 'user*') ? 'active' : ''}}">
            <a class="nav-link {{ request() -> is('kades*', 'sekdes*', 'user*') ? 'aria-expanded= "true"' : 'collapsed'}}" href="#" data-toggle="collapse" data-target="#colapselevel"
                aria-expanded="true" aria-controls="colapselevel">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <span>Admin</span>
            </a>
            <div id="colapselevel" class="collapse {{ request() -> is('kades*', 'sekdes*', 'user*') ? 'show' : '' }}" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Admin:</h6>
                    <a class="collapse-item {{ Request::is('kades*') ? 'active' : '' }}" href="/kades">Data Kepala Desa</a>
                    <a class="collapse-item {{ Request::is('sekdes*') ? 'active' : '' }}" href="/sekdes">Data Sekertaris Desa</a>
                    <a class="collapse-item {{ Request::is('user*') ? 'active' : '' }}" href="/user">Data User</a>
                </div>
            </div>
        </li>

        <!-- NAV Item - Tentang Desa Ngilen -->
        <li class="nav-item  {{ request() -> is('tentang', 'alamat', 'struktur', 'visimisi') ? 'active' : ''}}">
            <a class="nav-link {{ request() -> is('tentang', 'alamat', 'struktur', 'visimisi') ?'aria-expanded= "true"' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#about"
                aria-expanded="true" aria-controls="about">
                <i class="fa fa-users" aria-hidden="true"></i>
                <span>Profil Desa Ngilen</span>
            </a>
            <div id="about" class="collapse {{ request() -> is('tentang', 'alamat', 'struktur', 'visimisi') ? 'show' : '' }}" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Desa Ngilen:</h6>
                    <a class="collapse-item {{ Request::is('tentang') ? 'active' : '' }}" href="/tentang">Tentang Desa ngilen</a>
                    <a class="collapse-item {{ Request::is('alamat') ? 'active' : '' }}" href="/alamat">Alamat</a>
                    <a class="collapse-item {{ Request::is('struktur') ? 'active' : '' }}" href="/struktur">Struktur Organisasi</a>
                    <a class="collapse-item {{ Request::is('visimisi') ? 'active' : '' }}" href="/visimisi">Visi & Misi</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Pengaturan
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Pengaturan Akun</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                <a class="collapse-item" href="/register">Registrasi</a>
                <a class="collapse-item" href="forget-password">Lupa Password</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
        </li>

{{-- HAK AKSES SEKDES --}}
@elseif (auth()->user()->level=="SEKDES")

        <!-- Nav Item - Pages Kependudukan Menu -->
        <li class="nav-item {{ request() -> is('penduduk*', 'kk*', 'kelahiran*', 'kematian*', 'pindah*', 'datang*') ? 'active' : ''}}">
            <a class="nav-link {{ request() -> is('penduduk*', 'kk*', 'kelahiran*', 'kematian*', 'pindah*', 'datang*') ? 'aria-expanded= "true"' : 'collapsed'}}"href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fa fa-folder-open" aria-hidden="true"></i>
                <span>Data Kependudukan</span>
            </a>
            <div id="collapseTwo" class="collapse {{ request() -> is('penduduk*', 'kk*', 'kelahiran*', 'kematian*', 'pindah*', 'datang*') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Menampilkan Data:</h6>
                    <a class="collapse-item {{ Request::is('penduduk*') ? 'active' : '' }}" href="/penduduk">Data Penduduk</a>
                    <a class="collapse-item {{ Request::is('kk*') ? 'active' : '' }}" href="/kk">Data Kartu Keluarga</a>
                    <a class="collapse-item {{ Request::is('kelahiran*') ? 'active' : '' }}" href="/kelahiran">Data Kelahiran</a>
                    <a class="collapse-item {{ Request::is('kematian*') ? 'active' : '' }}" href="/kematian">Data Kematian</a>
                    <a class="collapse-item {{ Request::is('pindah*') ? 'active' : '' }}" href="/pindah">Data Pindah</a>
                    <a class="collapse-item {{ Request::is('datang*') ? 'active' : '' }}" href="/datang">Data Datang</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Tambah data Menu -->
        <li class="nav-item  {{ request() -> is('kades*', 'sekdes*', 'user*') ? 'active' : ''}}">
            <a class="nav-link {{ request() -> is('kades*', 'sekdes*', 'user*') ? 'aria-expanded= "true"' : 'collapsed'}}" href="#" data-toggle="collapse" data-target="#colapselevel"
                aria-expanded="true" aria-controls="colapselevel">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <span>Admin</span>
            </a>
            <div id="colapselevel" class="collapse {{ request() -> is('kades*', 'sekdes*', 'user*') ? 'show' : '' }}" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Data Admin:</h6>
                    <a class="collapse-item {{ Request::is('kades*') ? 'active' : '' }}" href="/kades">Data Kepala Desa</a>
                    <a class="collapse-item {{ Request::is('sekdes*') ? 'active' : '' }}" href="/sekdes">Data Sekertaris Desa</a>
                    <a class="collapse-item {{ Request::is('user*') ? 'active' : '' }}" href="/user">Data User</a>
                </div>
            </div>
        </li>

        <!-- NAV Item - Tentang Desa Ngilen -->
        <li class="nav-item  {{ request() -> is('tentang', 'alamat', 'struktur', 'visimisi') ? 'active' : ''}}">
            <a class="nav-link {{ request() -> is('tentang', 'alamat', 'struktur', 'visimisi') ?'aria-expanded= "true"' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#about"
                aria-expanded="true" aria-controls="about">
                <i class="fa fa-users" aria-hidden="true"></i>
                <span>Profil Desa Ngilen</span>
            </a>
            <div id="about" class="collapse {{ request() -> is('tentang', 'alamat', 'struktur', 'visimisi') ? 'show' : '' }}" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Desa Ngilen:</h6>
                    <a class="collapse-item {{ Request::is('tentang') ? 'active' : '' }}" href="/tentang">Tentang Desa ngilen</a>
                    <a class="collapse-item {{ Request::is('alamat') ? 'active' : '' }}" href="/alamat">Alamat</a>
                    <a class="collapse-item {{ Request::is('struktur') ? 'active' : '' }}" href="/struktur">Struktur Organisasi</a>
                    <a class="collapse-item {{ Request::is('visimisi') ? 'active' : '' }}" href="/visimisi">Visi & Misi</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Pengaturan
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Pengaturan Akun</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                <a class="collapse-item" href="/register">Registrasi</a>
                <a class="collapse-item" href="forget-password">Lupa Password</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
        </li>


{{-- HAK AKSES USER --}}
@elseif (auth()->user()->level=="USER")

        <!-- NAV Item - Tentang Desa Ngilen -->
        <li class="nav-item  {{ request() -> is('tentang', 'alamat', 'struktur', 'visimisi') ? 'active' : ''}}">
            <a class="nav-link {{ request() -> is('tentang', 'alamat', 'struktur', 'visimisi') ?'aria-expanded= "true"' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#about"
                aria-expanded="true" aria-controls="about">
                <i class="fa fa-users" aria-hidden="true"></i>
                <span>Profil Desa Ngilen</span>
            </a>
            <div id="about" class="collapse {{ request() -> is('tentang', 'alamat', 'struktur', 'visimisi') ? 'show' : '' }}" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Desa Ngilen:</h6>
                    <a class="collapse-item {{ Request::is('tentang') ? 'active' : '' }}" href="/tentang">Tentang Desa ngilen</a>
                    <a class="collapse-item {{ Request::is('alamat') ? 'active' : '' }}" href="/alamat">Alamat</a>
                    <a class="collapse-item {{ Request::is('struktur') ? 'active' : '' }}" href="/struktur">Struktur Organisasi</a>
                    <a class="collapse-item {{ Request::is('visimisi') ? 'active' : '' }}" href="/visimisi">Visi & Misi</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Pengaturan
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Pengaturan Akun</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
                <a class="collapse-item" href="/register">Registrasi</a>
                <a class="collapse-item" href="forget-password">Lupa Password</a>
                <div class="collapse-divider"></div>
            </div>
        </div>
        </li>

@endif


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

        <h4> Sistem Informasi Kependudukan </h4>

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Dropdown - Messages -->
            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
            aria-labelledby="searchDropdown">
            <form class="form-inline mr-auto w-100 navbar-search">
                <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small"
                    placeholder="Search for..." aria-label="Search"
                    aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </li>


    <div class="topbar-divider d-none d-sm-block"></div>

    <!-- Nav Item - User Information -->
    <li class="nav-item dropdown no-arrow">
        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ Auth::user()->name }} </span>
        <img class="img-profile rounded-circle"
        src="{{ asset('style/img/undraw_posting_photo.svg') }}">
    </a>
    <!-- Dropdown - User Information -->
    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
    aria-labelledby="userDropdown">
    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
        Logout
    </a>
</div>
</li>

</ul>

</nav>