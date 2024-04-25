<x-guest-layout>

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    </head>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <x-navbar-guest />
        <div class="pt-2 pb-1 bg-cover"
            style="background-image: url('../assets/img/dashboard.png'); background-position: bottom;">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card card-background card-background-after-none align-items-start mt-4 mb-2">
                        <div class="full-background"
                            style="background-image: url('../assets/img/header-blue-purple.jpg')"></div>
                        <div class="card-body text-start p-4 w-100">
                            <h3 class="text-white mb-2">SELAMAT DATANG DI PERPUSTAKAAN SMPN 1 LAWANG 🔥</h3>
                            <p class="mb-4 font-weight-semibold">
                                Silahkan Absen Terlebih Dahulu !!!
                            </p>
                            <button type="button"
                                class="btn btn-outline-white btn-blur btn-icon d-flex align-items-center mb-0">
                                <span class="btn-inner--icon">
                                    <svg width="14" height="14" viewBox="0 0 14 14"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="d-block me-2">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M1.5 2C0.671573 2 0 2.67157 0 3.5V10.5C0 11.3284 0.671573 12 1.5 12H12.5C13.3284 12 14 11.3284 14 10.5V3.5C14 2.67157 13.3284 2 12.5 2H1.5ZM1 3.5C1 3.22386 1.22386 3 1.5 3H12.5C12.7761 3 13 3.22386 13 3.5V10.5C13 10.7761 12.7761 11 12.5 11H1.5C1.22386 11 1 10.7761 1 10.5V3.5ZM4 6C4 5.72386 4.22386 5.5 4.5 5.5H9.5C9.77614 5.5 10 5.72386 10 6C10 6.27614 9.77614 6.5 9.5 6.5H4.5C4.22386 6.5 4 6.27614 4 6ZM4.5 7C4.22386 7 4 7.22386 4 7.5C4 7.77614 4.22386 8 4.5 8H9.5C9.77614 8 10 7.77614 10 7.5C10 7.22386 9.77614 7 9.5 7H4.5ZM4.5 8.5C4.22386 8.5 4 8.72386 4 9C4 9.27614 4.22386 9.5 4.5 9.5H9.5C9.77614 9.5 10 9.27614 10 9C10 8.72386 9.77614 8.5 9.5 8.5H4.5Z" />
                                    </svg>
                                </span>
                                <span class="btn-inner--text">ABSEN</span>
                            </button>
                            <img src="../assets/img/3d-cube.png" alt="3d-cube"
                                class="position-absolute top-0 end-1 w-25 max-width-200 mt-n6 d-sm-block d-none" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-3 py-3">
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="row">
                        <div class="col-md-10 mx-auto">
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="0" class="active" aria-current="true"
                                        aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators"
                                        data-bs-slide-to="2" aria-label="Slide 3"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('assets/img/sekolah.jpg') }}"
                                            class="d-block w-100 object-fit-cover carousel-img" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('assets/img/perpus.jpg') }}"
                                            class="d-block w-100 object-fit-cover carousel-img" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="{{ asset('assets/img/perpus_2.jpg') }}"
                                            class="d-block w-100 object-fit-cover carousel-img" alt="...">
                                    </div>
                                </div>

                                <style>
                                    .carousel-img {
                                        height: 600px;
                                        object-fit: cover;
                                    }
                                </style>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card shadow-xs border mb-4 pb-3">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0 font-weight-semibold text-lg">Last articles</h6>
                            <p class="text-sm mb-1">Here you will find the latest articles.</p>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                                    <div
                                        class="card card-background border-radius-xl card-background-after-none align-items-start mb-4">
                                        <div class="full-background bg-cover"
                                            style="background-image: url('../assets/img/img-8.jpg')"></div>
                                        <span class="mask bg-dark opacity-1 border-radius-sm"></span>
                                        <div class="card-body text-start p-3 w-100">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div
                                                        class="blur shadow d-flex align-items-center w-100 border-radius-md border border-white mt-8 p-3">
                                                        <div class="w-50">
                                                            <p class="text-dark text-sm font-weight-bold mb-1">Sara
                                                                Lamalo</p>
                                                            <p class="text-xs text-secondary mb-0">20 Jul 2022</p>
                                                        </div>
                                                        <p class="text-dark text-sm font-weight-bold ms-auto">
                                                            Growth
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:;">
                                        <h4 class="font-weight-semibold">
                                            Best strategy games
                                        </h4>
                                    </a>
                                    <p class="mb-4">
                                        As Uber works through a huge amount of internal management turmoil.
                                    </p>
                                    <a href="javascript:;"
                                        class="text-dark font-weight-semibold icon-move-right mt-auto w-100 mb-5">
                                        Read post
                                        <i class="fas fa-arrow-right-long text-sm ms-1" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                                    <div
                                        class="card card-background border-radius-xl card-background-after-none align-items-start mb-4">
                                        <div class="full-background bg-cover"
                                            style="background-image: url('../assets/img/img-9.jpg')"></div>
                                        <span class="mask bg-dark opacity-1 border-radius-sm"></span>
                                        <div class="card-body text-start p-3 w-100">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div
                                                        class="blur shadow d-flex align-items-center w-100 border-radius-md border border-white mt-8 p-3">
                                                        <div class="w-50">
                                                            <p class="text-dark text-sm font-weight-bold mb-1">
                                                                Charles
                                                                Deluvio</p>
                                                            <p class="text-xs text-secondary mb-0">17 Jul 2022</p>
                                                        </div>
                                                        <p class="text-dark text-sm font-weight-bold ms-auto">
                                                            Education
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="javascript:;">
                                        <h4 class="font-weight-semibold">
                                            Don't be afraid to be wrong
                                        </h4>
                                    </a>
                                    <p class="mb-4">
                                        As Uber works through a huge amount of internal management turmoil.
                                    </p>
                                    <a href="javascript:;"
                                        class="text-dark font-weight-semibold icon-move-right mt-auto w-100 mb-5">
                                        Read post
                                        <i class="fas fa-arrow-right-long text-sm ms-1" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="col-xl-4 col-md-6 mb-xl-0 mb-4">
                                    <div class="card h-100 card-plain border border-dashed px-5">
                                        <div class="card-body d-flex flex-column justify-content-center text-center">
                                            <a href="javascript:;">
                                                <div
                                                    class="icon icon-shape bg-dark text-center text-white rounded-circle mx-auto d-flex align-items-center justify-content-center mb-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="19"
                                                        width="19" viewBox="0 0 24 24" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                                <h5 class="text-dark text-lg"> Create new post </h5>
                                                <p class="text-sm text-secondary mb-0">Drive into the editor and
                                                    add
                                                    your content.</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-guest.footer />
        </div>
    </div>
</x-guest-layout>
<script>
    $(document).ready(function() {
        $('button.btn-outline-white').click(function() {
            $.ajax({
                url: "{{ route('kunjungan.store') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>
