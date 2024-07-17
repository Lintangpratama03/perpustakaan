<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        }

        .navbar-bg {
            padding-top: 70px;
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
                    data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon mt-2">
                        <span class="navbar-toggler-bar bar1"></span>
                        <span class="navbar-toggler-bar bar2"></span>
                        <span class="navbar-toggler-bar bar3"></span>
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navigation">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                            <a href="{{ route('dashboard-anggota') }}" id="dashboard-link"
                                class="nav-link text-black p-0">Dashboard</a>
                        </li>
                        <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center dropdown">
                            <a href="#" class="nav-link text-black p-0 dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">Buku</a>
                            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                <li><a class="dropdown-item" href="{{ route('buku-anggota') }}">Katalog Buku</a></li>
                                @auth
                                    @if (Auth::user()->id_posisi == 2)
                                        <li><a class="dropdown-item" href="{{ route('shopping.cart') }}">Pinjam
                                                Buku</a></li>
                                    @endif
                                @endauth
                            </ul>
                        </li>
                        @auth
                            @if (Auth::user()->id_posisi == 3)
                                <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                                    <a href="{{ route('pengajuan') }}" class="nav-link text-black p-0">Pengajuan
                                        RFID</a>
                                </li>
                            @endif
                            @if (Auth::user()->id_posisi == 2)
                                <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center dropdown">
                                    <a href="#" class="nav-link text-black p-0 dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">Peminjaman</a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                        <li><a class="dropdown-item" href="{{ route('ajuan-peminjaman-anggota') }}">Ajuan
                                                Peminjaman</a></li>
                                        <li><a class="dropdown-item" href="{{ route('sukses-peminjaman-anggota') }}">History
                                                Peminjaman</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center dropdown">
                                    <a href="#" class="nav-link text-black p-0 dropdown-toggle"
                                        data-bs-toggle="dropdown" aria-expanded="false">Pengembalian</a>
                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                        <li><a class="dropdown-item" href="{{ route('pengembalian-buku') }}">Belum
                                                Kembali</a></li>
                                        <li><a class="dropdown-item" href="{{ route('sukses-pengembalian-buku') }}">Sukses
                                                Kembali</a></li>
                                    </ul>
                                </li>
                            @endif
                            <li class="nav-item d-flex align-items-center font-weight-bold breadcrumb-text text-black">
                                <form method="POST" action="{{ route('logoutt') }}">
                                    @csrf
                                    <a href="login" onclick="event.preventDefault();this.closest('form').submit();">
                                        <button class="btn btn-sm btn-white mb-0 me-1 text-black logout-btn"
                                            type="submit">Log out</button>
                                    </a>
                                </form>
                            </li>
                            <li class="nav-item dropdown px-3 py-3 border-radius-sm d-flex align-items-center">
                                <a class="nav-link p-0 text-black d-flex align-items-center" href="#"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    @if (Auth::user()->image)
                                        <div class="avatar avatar-sm position-relative me-2">
                                            <img src="{{ asset('assets/img/foto-profil/' . Auth::user()->image) }}"
                                                class="w-100 border-radius-md" alt="profile_image">
                                        </div>
                                    @else
                                        <div class="avatar avatar-sm position-relative me-2">
                                            <img src="../assets/img/team-2.jpg" alt="profile_image"
                                                class="w-100 border-radius-md">
                                        </div>
                                    @endif
                                    <span class="font-weight-bold">{{ Auth::user()->name }}</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-animated">
                                    <li><a class="dropdown-item" href="{{ route('users.profile.anggota') }}">Profile</a>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item px-3 py-3 border-radius-sm d-flex align-items-center">
                                <a href="{{ route('sign-in') }}" class="nav-link text-black p-0">Login</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</body>

</html>
