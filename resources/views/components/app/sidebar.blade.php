<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-bars p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-xl-none"
            aria-hidden="true" id="iconSidenav" data-bs-toggle="collapse" data-bs-target="#sidenav-collapse-main"
            aria-controls="sidenav-collapse-main" aria-expanded="false" aria-label="Toggle sidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0" href="{{ route('dashboard') }}" target="_blank"
            style="width: 100%;">
            <img src="../assets/img/logo-dashboard.png" class="w-100" alt="spotify">
        </a>
    </div>
    <div class="collapse navbar-collapse px-4" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <ul class="collapsible">
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="collapsible-header d-flex align-items-center collapsed text-white">
                        <i class="fas fa-tachometer-alt fa-fw me-2 text-white"></i>
                        <span class="font-weight-normal text-md ms-2 text-white">Dashboard</span>
                    </a>
                </li>
            </ul>
            <ul class="collapsible">
                <li>
                    <a href="#" class="collapsible-header d-flex align-items-center collapsed text-white">
                        <i class="fas fa-users fa-fw me-2 text-white"></i>
                        <span class="font-weight-normal text-md ms-2 text-white">Kelola User</span>
                        <i class="fas fa-chevron-down ms-auto transition-transform text-white"></i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('users.profile') }}" class="text-white">Profil Saya</a></li>
                            <li><a href="{{ route('users-management') }}" class="text-white">Anggota</a></li>
                            <li><a href="{{ route('usersUpgrade-management') }}" class="text-white">Pengajuan RFID</a>
                            </li>
                            <li><a href="{{ route('usersrfid-management') }}" class="text-white">Anggota RFID</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="collapsible">
                <li>
                    <a href="#" class="collapsible-header d-flex align-items-center collapsed text-white">
                        <i class="fas fa-id-card fa-fw me-2 text-white"></i>
                        <span class="font-weight-normal text-md ms-2 text-white">Data</span>
                        <i class="fas fa-chevron-down ms-auto transition-transform text-white"></i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('rfid') }}" class="text-white">History SCAN</a></li>
                            <li><a href="{{ route('kunjungan') }}" class="text-white">Pengunjung</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="collapsible">
                <li>
                    <a href="#" class="collapsible-header d-flex align-items-center collapsed text-white">
                        <i class="fas fa-book fa-fw me-2 text-white"></i>
                        <span class="font-weight-normal text-md ms-2 text-white">Buku</span>
                        <i class="fas fa-chevron-down ms-auto transition-transform text-white"></i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('buku') }}" class="text-white">Kelola Buku</a></li>
                            <li><a href="{{ route('rak') }}" class="text-white">Kelola Rak Buku</a></li>
                            <li><a href="{{ route('penerbit') }}" class="text-white">Kelola Penerbit</a></li>
                            <li><a href="{{ route('pengarang') }}" class="text-white">Kelola Pengarang</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="collapsible">
                <li>
                    <a href="#" class="collapsible-header d-flex align-items-center collapsed text-white">
                        <i class="fas fa-upload fa-fw me-2 text-white"></i>
                        <span class="font-weight-normal text-md ms-2 text-white">Peminjaman</span>
                        <i class="fas fa-chevron-down ms-auto transition-transform text-white"></i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('ajuan') }}" class="text-white">Ajuan Peminjaman</a></li>
                            <li><a href="{{ route('ajuan.sukses') }}" class="text-white">Peminjaman Sukses</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="collapsible">
                <li>
                    <a href="#" class="collapsible-header d-flex align-items-center collapsed text-white">
                        <i class="fas fa-download fa-fw me-2 text-white"></i>
                        <span class="font-weight-normal text-md ms-2 text-white">Pengembalian</span>
                        <i class="fas fa-chevron-down ms-auto transition-transform text-white"></i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('kembali') }}" class="text-white">Ajuan Pengembalian</a></li>
                            <li><a href="{{ route('kembali.sukses') }}" class="text-white">History Kembali</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </ul>
    </div>
    <style>
        .navbar-nav li a,
        .navbar-nav li a:hover {
            color: #FFFFFF;
            text-decoration: none;
        }

        .collapsible-header:hover .fa-chevron-down {
            transform: rotate(180deg);
        }

        .collapsible {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .collapsible li {
            border-bottom: 1px solid #ddd;
        }

        .collapsible-header {
            display: block;
            padding: 10px;
            background-color: #f5f5f500;
            text-decoration: none;
            /* Menghilangkan underline pada collapsible-header */
            color: #333;
            cursor: pointer;
        }

        .collapsible-body {
            display: none;
            padding: 10px;
            background-color: #ffffff00;
        }

        .collapsible-body ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .collapsible-body li a {
            display: block;
            padding: 5px 10px;
            color: #333;
            text-decoration: none;
            /* Menghilangkan underline pada collapsible-body li a */
        }

        .collapsible-body li a:hover {
            background-color: #5508d1;
        }
    </style>
    <script>
        var collapsibleHeaders = document.querySelectorAll(".collapsible-header");

        collapsibleHeaders.forEach(function(header) {
            header.addEventListener("click", function() {
                var collapsibleBody = this.nextElementSibling;
                if (collapsibleBody.style.display === "none") {
                    collapsibleBody.style.display = "block";
                } else {
                    collapsibleBody.style.display = "none";
                }
            });
        });
    </script>
</aside>
