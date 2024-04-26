<x-app-layout>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-md-flex align-items-center mb-3 mx-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">Hello, Admin</h3>
                            <p class="mb-0">Selamat Datang di E-Perpus</p>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-0">
            <div class="row">
                <div class="position-relative overflow-hidden">
                    <div class="swiper mySwiper mt-4 mb-2">
                        <div class="mb-md-0 mb-3">
                            <h3 class="font-weight-bold mb-0">RFID</h3>
                        </div>
                        <div class="swiper-wrapper">
                            @foreach ($swiperData as $item)
                                <div class="swiper-slide">
                                    <div
                                        class="card card-background shadow-none border-radius-xl card-background-after-none align-items-start mb-0">
                                        <div class="full-background bg-cover"
                                            style="background-image: url('../assets/img/rfid.png')"></div>
                                        <div class="card-body text-start px-3 py-0 w-100">
                                            <div class="row mt-12">
                                                <div class="col-sm-3 mt-auto">
                                                    <h4 class="text-gold font-weight-bolder">#{{ $loop->iteration }}
                                                    </h4>
                                                    <p class="text-muted text-xs font-weight-bolder mb-0">Nama</p>
                                                    <h5 class="font-weight-bolder text-gold">{{ $item['name'] }}</h5>
                                                </div>
                                                <div class="col-sm-3 ms-auto mt-auto">
                                                    <p class="text-muted text-xs font-weight-bolder mb-0">NIS</p>
                                                    <h5 class="font-weight-bolder text-gold">{{ $item['nis'] }}</h5>
                                                </div>
                                                <style>
                                                    .text-gold {
                                                        color: #d7e2c4;
                                                    }
                                                </style>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
            <div class="row my-4">
                <div class="col-lg-4 col-md-6 mb-md-0 mb-4">
                    <div class="card shadow-xs border h-100">
                        <div class="card-header pb-0">
                            <h6 class="font-weight-semibold text-lg mb-0">Data Pinjam Buku</h6>
                            <p class="text-sm">Data Tahun 2024.</p>
                            {{-- <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="btnradio" id="btnradio1"
                                    autocomplete="off" checked>
                                <label class="btn btn-white px-3 mb-0" for="btnradio1">12 months</label>
                                <input type="radio" class="btn-check" name="btnradio" id="btnradio2"
                                    autocomplete="off">
                                <label class="btn btn-white px-3 mb-0" for="btnradio2">30 days</label>
                                <input type="radio" class="btn-check" name="btnradio" id="btnradio3"
                                    autocomplete="off">
                                <label class="btn btn-white px-3 mb-0" for="btnradio3">7 days</label>
                            </div> --}}
                        </div>
                        <div class="card-body py-3">
                            <div class="chart mb-2">
                                <canvas id="chart-pinjam" class="chart-canvas" height="240"></canvas>
                            </div>
                            {{-- <button class="btn btn-white mb-0 ms-auto">View report</button> --}}
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-6">
                    <div class="card shadow-xs border">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center mb-3">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Detail Data Peminjaman</h6>
                                    <p class="text-sm mb-sm-0 mb-2">Data 5 Terbaru</p>
                                </div>
                            </div>
                            <div class="pb-1 d-sm-flex align-items-center">
                                <div class="w-sm-25 ms-auto">
                                    <a href="{{ route('ajuan.sukses') }}" class="btn btn-dark btn-primary">
                                        Selengkapnya <i class="fas fa-angle-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0" id="table-oke">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                                No</th>
                                            <th
                                                class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                                Nama Peminjam</th>
                                            <th
                                                class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                                NIS</th>
                                            <th
                                                class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                                Tanggal Pinjam</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($pinjam->isEmpty())
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="text-left">TIDAK ADA DATA</td>
                                                <td></td>
                                            </tr>
                                        @else
                                            @php
                                                $nomor_urut = 1;
                                            @endphp
                                            @foreach ($pinjam as $pjm)
                                                <tr>
                                                    <td class="text-center">{{ $nomor_urut++ }}</td>
                                                    <td class="text-center">{{ $pjm->name_user }}</td>
                                                    <td class="text-center">{{ $pjm->nis }}</td>
                                                    <td class="text-center">{{ $pjm->tanggal_pinjam }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M4.5 3.75a3 3 0 00-3 3v.75h21v-.75a3 3 0 00-3-3h-15z" />
                                    <path fill-rule="evenodd"
                                        d="M22.5 9.75h-21v7.5a3 3 0 003 3h15a3 3 0 003-3v-7.5zm-18 3.75a.75.75 0 01.75-.75h6a.75.75 0 010 1.5h-6a.75.75 0 01-.75-.75zm.75 2.25a.75.75 0 000 1.5h3a.75.75 0 000-1.5h-3z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">Anggota Biasa</p>
                                        <h4 class="mb-2 font-weight-bold">{{ $anggota }}</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-chevron-up text-xs me-1"></i>10.5%
                                            </span>
                                            <span class="text-sm ms-1">from $89,740.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M7.5 5.25a3 3 0 013-3h3a3 3 0 013 3v.205c.933.085 1.857.197 2.774.334 1.454.218 2.476 1.483 2.476 2.917v3.033c0 1.211-.734 2.352-1.936 2.752A24.726 24.726 0 0112 15.75c-2.73 0-5.357-.442-7.814-1.259-1.202-.4-1.936-1.541-1.936-2.752V8.706c0-1.434 1.022-2.7 2.476-2.917A48.814 48.814 0 017.5 5.455V5.25zm7.5 0v.09a49.488 49.488 0 00-6 0v-.09a1.5 1.5 0 011.5-1.5h3a1.5 1.5 0 011.5 1.5zm-3 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z"
                                        clip-rule="evenodd" />
                                    <path
                                        d="M3 18.4v-2.796a4.3 4.3 0 00.713.31A26.226 26.226 0 0012 17.25c2.892 0 5.68-.468 8.287-1.335.252-.084.49-.189.713-.311V18.4c0 1.452-1.047 2.728-2.523 2.923-2.12.282-4.282.427-6.477.427a49.19 49.19 0 01-6.477-.427C4.047 21.128 3 19.852 3 18.4z" />
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">Anggota RFID</p>
                                        <h4 class="mb-2 font-weight-bold">{{ $anggota_rfid }}</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-chevron-up text-xs me-1"></i>55%
                                            </span>
                                            <span class="text-sm ms-1">from 243</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 6a3 3 0 013-3h12a3 3 0 013 3v12a3 3 0 01-3 3H6a3 3 0 01-3-3V6zm4.5 7.5a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0v-2.25a.75.75 0 01.75-.75zm3.75-1.5a.75.75 0 00-1.5 0v4.5a.75.75 0 001.5 0V12zm2.25-3a.75.75 0 01.75.75v6.75a.75.75 0 01-1.5 0V9.75A.75.75 0 0113.5 9zm3.75-1.5a.75.75 0 00-1.5 0v9a.75.75 0 001.5 0v-9z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">Pengajuan RFID</p>
                                        <h4 class="mb-2 font-weight-bold">{{ $anggota_minta }}</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-chevron-up text-xs me-1"></i>22%
                                            </span>
                                            <span class="text-sm ms-1">from $369.30</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-body text-start p-3 w-100">
                            <div
                                class="icon icon-shape icon-sm bg-dark text-white text-center border-radius-sm d-flex align-items-center justify-content-center mb-3">
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5.25 2.25a3 3 0 00-3 3v4.318a3 3 0 00.879 2.121l9.58 9.581c.92.92 2.39 1.186 3.548.428a18.849 18.849 0 005.441-5.44c.758-1.16.492-2.629-.428-3.548l-9.58-9.581a3 3 0 00-2.122-.879H5.25zM6.375 7.5a1.125 1.125 0 100-2.25 1.125 1.125 0 000 2.25z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="w-100">
                                        <p class="text-sm text-secondary mb-1">Anggota Terhapus</p>
                                        <h4 class="mb-2 font-weight-bold">{{ $hapus }}</h4>
                                        <div class="d-flex align-items-center">
                                            <span class="text-sm text-success font-weight-bolder">
                                                <i class="fa fa-chevron-up text-xs me-1"></i>18%
                                            </span>
                                            <span class="text-sm ms-1">from $19,800.40</span>
                                        </div>
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
                                    {{-- <button type="button" class="btn btn-sm btn-white mb-0 me-2">
                                        View report
                                    </button> --}}
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
            <x-app.footer />
        </div>
    </main>

</x-app-layout>
<script>
    function getKunjunganData() {
        fetch("{{ route('kunjungan.dashboard') }}")
            .then(response => response.json())
            .then(data => {
                drawChart(data.labels, data.data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function getPinjamData() {
        fetch("{{ route('pinjam.dashboard') }}")
            .then(response => response.json())
            .then(data => {
                drawChartPinjam(data.labels, data.data);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    function drawChartPinjam(labels, data) {
        var ctx = document.getElementById("chart-pinjam").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                    label: "Total Peminjaman",
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
        getPinjamData();
    });
</script>
