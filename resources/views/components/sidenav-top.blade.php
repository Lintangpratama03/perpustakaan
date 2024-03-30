<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
</head>
<style>
    .logout-btn:hover {
        color: black !important;
    }
</style>
<nav class="navbar bg-slate-900 navbar-expand-lg flex-wrap top-0 px-0 py-0">
    <div class="container py-2">
        <nav aria-label="breadcrumb">
            <div class="d-flex align-items-center">
                <span class="px-3 font-weight-bold text-lg text-white me-4">PERPUSTAKAAN</span>
            </div>
        </nav>
        <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                <a href="{{ route('dashboard-anggota') }}" id="dashboard-link"
                    class="nav-link text-white p-0">Dashboard</a>
            </li>
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center dropdown">
                <a href="#" class="nav-link text-white p-0 dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">Buku</a>
                <ul class="dropdown-menu dropdown-menu-animated">
                    <li><a class="dropdown-item" href="{{ route('buku-anggota') }}">Katalog Buku</a></li>
                    <li><a class="dropdown-item" href="{{ route('shopping.cart') }}">Keranjang Buku</a></li>
                </ul>
            </li>
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center dropdown">
                <a href="#" class="nav-link text-white p-0 dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">Peminjaman</a>
                <ul class="dropdown-menu dropdown-menu-animated">
                    <li><a class="dropdown-item" href="{{ route('ajuan-peminjaman-anggota') }}">Ajuan Peminjaman</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('sukses-peminjaman-anggota') }}">History Peminjaman</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center dropdown">
                <a href="#" class="nav-link text-white p-0 dropdown-toggle" data-bs-toggle="dropdown"
                    aria-expanded="false">Pengembalian</a>
                <ul class="dropdown-menu dropdown-menu-animated">
                    <li><a class="dropdown-item" href="{{ route('pengembalian-buku') }}">Belum Kembali</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('sukses-peminjaman-anggota') }}">Sukses Kembali</a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="navbar-nav ms-md-auto justify-content-end">
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                            <i class="sidenav-toggler-line bg-white"></i>
                        </div>
                    </a>
                </li>
                <li class="nav-item d-flex align-items-center font-weight-bold breadcrumb-text text-white">
                    <form method="POST" action="{{ route('logoutt') }}">
                        @csrf
                        <a href="login" onclick="event.preventDefault();this.closest('form').submit();">
                            <button class="btn btn-sm btn-white mb-0 me-1 text-white logout-btn" type="submit">Log
                                out</button>
                        </a>
                    </form>
                </li>
                <li class="nav-item d-flex align-items-center ps-2">
                    <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <li class="nav-item dropdown pe-2 d-flex align-items-center">
                    <div class="avatar avatar-sm position-relative">
                        <img src="../assets/img/team-2.jpg" alt="profile_image" class="w-100 border-radius-md">
                    </div>
                </li>
                </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<style>
    .dropdown-menu-animated {
        animation: growDown 300ms ease-in-out forwards;
        transform-origin: top center;
    }

    @keyframes growDown {
        0% {
            transform: scaleY(0);
        }

        100% {
            transform: scaleY(1);
        }
    }
</style>
