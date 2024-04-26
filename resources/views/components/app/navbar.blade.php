<nav class="navbar navbar-expand-lg navbar-light border-radius-md bg-white z-index-3 py-3 " id="navbarBlur"
    navbar-scroll="true">
    <div class="container-fluid py-1 px-2">
        <nav aria-label="breadcrumb">
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <span class="input-group-text text-body bg-white  border-end-0 ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16px" height="16px" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </span>
                    <input type="text" class="form-control ps-0" placeholder="Search">
                </div>
            </div>
            <div class="mb-0 font-weight-bold breadcrumb-text text-white">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="login" onclick="event.preventDefault();
                this.closest('form').submit();">
                        <button class="btn btn-sm  btn-white  mb-0 me-1" type="submit">Log out</button>
                    </a>
                </form>
            </div>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item ps-2 d-flex align-items-center dropdown">
                    <a href="javascript:;" class="nav-link text-body p-0" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('assets/img/foto-profil/' . (auth()->user()->image ?? 'default.jpg')) }}"
                            class="avatar avatar-sm" alt="avatar" />
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('users.profile') }}">Setting</a></li>
                        <li><a class="dropdown-item" href="#">Ganti Password</a></li>
                    </ul>
                </li>
            </ul>
            <style>
                .dropdown-menu {
                    background-color: #6c757d;
                }

                .dropdown-item {
                    color: #ffffff;
                }

                .dropdown-item:hover {
                    background-color: #007bff;
                }
            </style>

        </div>
    </div>
</nav>
<!-- End Navbar -->
