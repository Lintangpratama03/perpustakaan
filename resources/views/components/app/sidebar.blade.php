<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 bg-slate-900 fixed-start " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand d-flex align-items-center m-0" href="{{ route('dashboard') }}" target="_blank"
            style="width: 100%;">
            <img src="../assets/img/logo-dashboard.png" class="w-100" alt="spotify">
        </a>
    </div>
    <div class="collapse navbar-collapse px-4  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link  {{ is_current_route('dashboard') ? 'active' : '' }}"
                    href="{{ route('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm px-0 text-center d-flex align-items-center justify-content-center">
                        <svg width="30px" height="30px" viewBox="0 0 48 48" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>dashboard</title>
                            <g id="dashboard" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <g id="template" transform="translate(12.000000, 12.000000)" fill="#FFFFFF"
                                    fill-rule="nonzero">
                                    <path class="color-foreground"
                                        d="M0,1.71428571 C0,0.76752 0.76752,0 1.71428571,0 L22.2857143,0 C23.2325143,0 24,0.76752 24,1.71428571 L24,5.14285714 C24,6.08962286 23.2325143,6.85714286 22.2857143,6.85714286 L1.71428571,6.85714286 C0.76752,6.85714286 0,6.08962286 0,5.14285714 L0,1.71428571 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M0,12 C0,11.0532171 0.76752,10.2857143 1.71428571,10.2857143 L12,10.2857143 C12.9468,10.2857143 13.7142857,11.0532171 13.7142857,12 L13.7142857,22.2857143 C13.7142857,23.2325143 12.9468,24 12,24 L1.71428571,24 C0.76752,24 0,23.2325143 0,22.2857143 L0,12 Z"
                                        id="Path"></path>
                                    <path class="color-background"
                                        d="M18.8571429,10.2857143 C17.9103429,10.2857143 17.1428571,11.0532171 17.1428571,12 L17.1428571,22.2857143 C17.1428571,23.2325143 17.9103429,24 18.8571429,24 L22.2857143,24 C23.2325143,24 24,23.2325143 24,22.2857143 L24,12 C24,11.0532171 23.2325143,10.2857143 22.2857143,10.2857143 L18.8571429,10.2857143 Z"
                                        id="Path"></path>
                                </g>
                            </g>
                        </svg>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <ul class="collapsible">
                <li>
                    <a href="#" class="collapsible-header d-flex align-items-center collapsed text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="ms-2 text-white"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-weight-normal text-md ms-2 text-white">Kelola User</span>
                        <i class="fas fa-chevron-down ms-auto transition-transform text-white"></i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('users.profile') }}" class="text-white">Profil Saya</a></li>
                            <li><a href="{{ route('users-management') }}" class="text-white">Anggota</a></li>
                            <li><a href="{{ route('usersrfid-management') }}" class="text-white">Anggota RFID</a></li>
                            <li><a href="{{ route('usersHapus-management') }}" class="text-white">Anggota Dihapus</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <ul class="collapsible">
                <li>
                    <a href="#" class="collapsible-header d-flex align-items-center collapsed text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" class="ms-2 text-white"
                            viewBox="0 0 24 24" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-weight-normal text-md ms-2 text-white">Kelola Buku</span>
                        <i class="fas fa-chevron-down ms-auto transition-transform text-white"></i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('users.profile') }}" class="text-white">Kelola Buku</a></li>
                            <li><a href="{{ route('users-management') }}" class="text-white">Kelola Kategori</a></li>
                            <li><a href="{{ route('usersrfid-management') }}" class="text-white">Kelola Penerbit</a>
                            </li>
                            <li><a href="{{ route('usersHapus-management') }}" class="text-white">Kelola Pengarang</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </ul>
    </div>
    <style>
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