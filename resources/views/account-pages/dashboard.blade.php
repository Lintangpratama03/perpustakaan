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
                            <h6 class="mb-0 font-weight-semibold text-lg">About</h6>
                            <p class="text-sm mb-1">Profil Sekolah</p>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-xl-5">
                                    <div
                                        class="card card-background border-radius-xl card-background-after-none align-items-start mb-4">
                                        <div class="full-background bg-cover"
                                            style="background-image: url('../assets/img/sekolah.jpg')"></div>
                                        <span class="mask bg-dark opacity-1 border-radius-sm"></span>
                                        <div class="card-body text-start p-3 w-100">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div
                                                        class="blur shadow d-flex align-items-center w-100 border-radius-md border border-white mt-8 p-3">
                                                        <div class="w-50">
                                                            <p class="text-dark text-sm font-weight-bold mb-1">SMPN 1
                                                                Lawang</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-7">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Profil SMPN 1 Lawang</h5>
                                            <p class="card-text">SMP Negeri 1 Lawang, Kabupaten Malang
                                                SMP Negeri 1 Lawang adalah sebuah lembaga sekolah SMP negeri yang
                                                alamatnya di Jl. Sumber Taman No. 50, Kab. Malang.
                                                SMP negeri ini didirikan pertama kali pada tahun 1978. Saat sekarang SMP
                                                Negeri 1 Lawang masih menggunakan program kurikulum belajar SMP 2013.
                                                SMP Negeri 1 Lawang memiliki kepala sekolah dengan nama Ridha Basuki
                                                dibantu oleh operator bernama Eko Yudi Susilo.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card shadow-xs border">
                            <div class="card-header pb-0">
                                <div class="d-sm-flex align-items-center mb-3">
                                    <div>
                                        <h6 class="font-weight-semibold text-lg mb-0">Data Pengunjung</h6>
                                        <p class="text-sm mb-sm-0 mb-2">Grafik pengunjung tahun 2024.</p>
                                    </div>
                                    <div class="ms-auto d-flex">
                                        <button type="button" class="btn btn-sm btn-white mb-0 me-2">
                                            View report
                                        </button>
                                    </div>
                                </div>
                                <div class="d-sm-flex align-items-center">
                                    <h4 class="mb-0 font-weight-semibold">Total Pengunjung : {{ $pengunjung }} Siswa
                                    </h4>
                                </div>
                                <br><br><br>
                            </div>
                            <div class="card-body p-3">
                                <div class="chart mt-n6">
                                    <canvas id="chart-line-kunjungan" class="chart-canvas" height="100"></canvas>
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


    function getKunjunganData() {
        fetch("{{ route('kunjungan.dashboard.umum') }}")
            .then(response => response.json())
            .then(data => {
                drawChart(data.labels, data.data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function drawChart(labels, data) {
        var ctx = document.getElementById("chart-line-kunjungan").getContext("2d");

        new Chart(ctx, {
            type: "line",
            data: {
                labels: labels,
                datasets: [{
                    label: "Jumlah Pengunjung",
                    tension: 0,
                    borderWidth: 2,
                    pointRadius: 3,
                    borderColor: "#2ca8ff",
                    pointBorderColor: '#2ca8ff',
                    pointBackgroundColor: '#2ca8ff',
                    fill: true,
                    data: data,
                    maxBarThickness: 6
                }],
            },
            options: {
                responsive: true,
                // maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        align: 'end',
                        labels: {
                            boxWidth: 6,
                            boxHeight: 6,
                            padding: 20,
                            pointStyle: 'circle',
                            borderRadius: 50,
                            usePointStyle: true,
                            font: {
                                weight: 400,
                            },
                        },
                    },
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#1e293b',
                        bodyColor: '#1e293b',
                        borderColor: '#e9ecef',
                        borderWidth: 1,
                        pointRadius: 2,
                        usePointStyle: true,
                        boxWidth: 8,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        ticks: {
                            stepSize: 2
                        },
                        display: true,
                        padding: 10,
                        color: '#b2b9bf',
                        font: {
                            size: 12,
                            family: "Noto Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                        color: "#64748B"
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [4, 4]
                        },
                        ticks: {
                            display: true,
                            color: '#b2b9bf',
                            padding: 20,
                            font: {
                                size: 12,
                                family: "Noto Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#64748B"
                        }
                    },
                }
            }
        });
    }
    document.addEventListener("DOMContentLoaded", function() {
        getKunjunganData();
    });
</script>
