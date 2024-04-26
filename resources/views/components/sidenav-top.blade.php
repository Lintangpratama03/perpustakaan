<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Background</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        .navbar {
            position: fixed;
            width: 100%;
            z-index: 1000;
            /* Ensure navbar is above the background image */
        }

        .navbar-bg {
            padding-top: 70px;
            /* Adjust this value to match the height of your navbar */
        }

        .logout-btn:hover {
            color: black !important;
        }

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
</head>

<body>
    <div class="navbar-bg" style="background-image: url('../assets/img/dashboard.png'); background-position: bottom;">
        <nav class="navbar navbar-expand-lg blur border-radius-sm top-0 z-index-3 shadow bg-slate-900">
            <div class="container-fluid px-1">
                <a class="navbar-brand font-weight-bolder ms-lg-0 text-black" href="#">
                    <img src="../assets/img/logo-ct.png" alt="Perpustakaan"
                        style="width: 50px; height: auto; margin-left: 10px;">
                    PERPUSTAKAAN
                </a>
                <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon mt-2">
                        <span class="navbar-toggler-bar bar1 bg-white"></span>
                        <span class="navbar-toggler-bar bar2 bg-white"></span>
                        <span class="navbar-toggler-bar bar3 bg-white"></span>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav d-lg-none ms-auto">
                        <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                            <a href="{{ route('dashboard-anggota') }}" id="dashboard-link"
                                class="nav-link text-black p-0">Dashboard</a>
                        </li>
                        <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center dropdown">
                            <a href="#" class="nav-link text-black p-0 dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">Buku</a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                <li><a class="dropdown-item" href="{{ route('buku-anggota') }}">Katalog Buku</a></li>
                                <li><a class="dropdown-item" href="{{ route('shopping.cart') }}">Keranjang Buku</a></li>
                            </ul>
                        </li>
                        <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center dropdown">
                            <a href="#" class="nav-link text-black p-0 dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">Peminjaman</a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                @auth
                                    <li><a class="dropdown-item" href="{{ route('ajuan-peminjaman-anggota') }}">Ajuan
                                            Peminjaman</a></li>
                                    <li><a class="dropdown-item" href="{{ route('sukses-peminjaman-anggota') }}">History
                                            Peminjaman</a></li>
                                @else
                                    <li><a class="dropdown-item">Silahkan Login</a></li>
                                @endauth
                            </ul>
                        </li>
                        <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center dropdown">
                            <a href="#" class="nav-link text-black p-0 dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">Pengembalian</a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                @auth
                                    <li><a class="dropdown-item" href="{{ route('pengembalian-buku') }}">Belum Kembali</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('sukses-pengembalian-buku') }}">Sukses
                                            Kembali</a></li>
                                @else
                                    <li><a class="dropdown-item">Silahkan Login</a></li>
                                @endauth
                            </ul>
                        </li>
                    </ul>
                    <ul class="navbar-nav d-none d-lg-flex ms-auto">
                        <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                            <a href="{{ route('dashboard-anggota') }}" id="dashboard-link"
                                class="nav-link text-black p-0">Dashboard</a>
                        </li>
                        <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center dropdown">
                            <a href="#" class="nav-link text-black p-0 dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">Buku</a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                <li><a class="dropdown-item" href="{{ route('buku-anggota') }}">Katalog Buku</a></li>
                                <li><a class="dropdown-item" href="{{ route('shopping.cart') }}">Keranjang Buku</a></li>
                            </ul>
                        </li>
                        <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center dropdown">
                            <a href="#" class="nav-link text-black p-0 dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">Peminjaman</a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                @auth
                                    <li><a class="dropdown-item" href="{{ route('ajuan-peminjaman-anggota') }}">Ajuan
                                            Peminjaman</a></li>
                                    <li><a class="dropdown-item" href="{{ route('sukses-peminjaman-anggota') }}">History
                                            Peminjaman</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('sign-in') }}">Silahkan Login</a></li>
                                @endauth
                            </ul>
                        </li>
                        <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center dropdown">
                            <a href="#" class="nav-link text-black p-0 dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">Pengembalian</a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                @auth
                                    <li><a class="dropdown-item" href="{{ route('pengembalian-buku') }}">Belum
                                            Kembali</a></li>
                                    <li><a class="dropdown-item" href="{{ route('sukses-pengembalian-buku') }}">Sukses
                                            Kembali</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('sign-in') }}">Silahkan
                                            Login</a></li>
                                @endauth
                            </ul>
                        </li>
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-black p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                    <i class="sidenav-toggler-line bg-white"></i>
                                </div>
                            </a>
                        </li>
                        @auth
                            <li class="nav-item d-flex align-items-center font-weight-bold breadcrumb-text text-black">
                                <form method="POST" action="{{ route('logoutt') }}">
                                    @csrf
                                    <a href="login" onclick="event.preventDefault();this.closest('form').submit();">
                                        <button class="btn btn-sm btn-white mb-0 me-1 text-black logout-btn"
                                            type="submit">Log out</button>
                                    </a>
                                </form>
                            </li>
                            <li class="nav-item d-flex align-items-center ps-2">
                                <a href="javascript:;" class="nav-link text-black font-weight-bold px-0">
                            <li class="nav-item dropdown pe-2 d-flex align-items-center">
                                <div class="avatar avatar-sm position-relative">
                                    <img src="../assets/img/team-2.jpg" alt="profile_image"
                                        class="w-100 border-radius-md">
                                </div>
                            </li>
                            </a>
                            </li>
                        @else
                            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                                <a href="{{ route('sign-in') }}" id="dashboard-link"
                                    class="nav-link text-black p-0">LOGIN</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</body>

</html>
