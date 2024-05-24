<x-guest-layout>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <x-navbar-guest />
        <div class="pt-7 pb-4 bg-cover"
            style="background-image: url('../assets/img/1.png'); background-position: bottom;"></div>
        <div class="container my-3 py-3">
            <span>
                <h5>*Denda 5000 setiap telat perhari</h5>
            </span>
            <div class="table-responsive">
                <table class="table text-secondary text-center">
                    <thead>
                        <tr>
                            <th
                                class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                No Transaksi</th>
                            <th
                                class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                Tanggal Pinjam</th>
                            <th
                                class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                Tenggat Kembali</th>
                            <th
                                class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                Status Pinjam</th>
                            <th
                                class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                Ajuan Perpanjang</th>
                            <th
                                class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                Total Denda</th>
                            <th
                                class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pinjam->isEmpty())
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>TIDAK ADA DATA</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @else
                            @foreach ($pinjam as $pjm)
                                <tr>
                                    <td class="text-center">{{ $pjm->id }}</td>
                                    <td class="text-center">{{ $pjm->tanggal_pinjam }}</td>
                                    <td class="text-center">{{ $pjm->tenggat_kembali }}</td>
                                    <td class="text-center">
                                        @if ($pjm->status == 3)
                                            <span
                                                class="badge badge-sm border border-danger text-danger bg-danger">{{ 'Belum Kembali' }}</span>
                                        @elseif ($pjm->status == 4)
                                            <span
                                                class="badge badge-sm border border-warning text-warning bg-warning">{{ 'Proses Scan' }}</span>
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($pjm->status_perpanjang == 0)
                                            <span
                                                class="badge badge-sm border border-danger text-danger bg-danger">{{ 'Tidak Mengajukan' }}</span>
                                        @elseif ($pjm->status_perpanjang == 1)
                                            <span
                                                class="badge badge-sm border border-warning text-warning bg-warning">{{ 'Proses Scan' }}</span>
                                        @elseif ($pjm->status_perpanjang == 2)
                                            <span
                                                class="badge badge-sm border border-success text-success bg-success">{{ 'Berhasil' }}</span>
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $pjm->denda }}</td>
                                    <td class="text-center">
                                        @if ($pjm->status == 3)
                                            <a href="#" class="mx-3 edit-btn" data-bs-toggle="modal"
                                                data-bs-target="#editMemberModal" data-id="{{ $pjm->id }}">
                                                <i class="fas fa-eye text-secondary"></i>
                                            </a>
                                        @elseif ($pjm->status == 4)
                                            <a href="#" class="mx-3 scan-btn" data-bs-toggle="modal"
                                                data-bs-target="#scanMemberModal" data-id="{{ $pjm->id }}">
                                                <i class="fa fa-id-badge text-secondary"></i>
                                            </a>
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                        @if ($pjm->status_perpanjang == 0)
                                            <a href="#" class="mx-3 panjang-btn" data-bs-toggle="modal"
                                                data-bs-target="#panjangModal" data-id="{{ $pjm->id }}">
                                                <i class="fas fa-upload text-secondary"></i>
                                            </a>
                                        @else
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="col-md-8">
                <div class="modal fade" id="editMemberModal" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-dark">Data Buku Yang Dipinjam</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" id="editMemberForm">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table">
                                                        <input type="hidden" id="id_peminjaman" name="id_peminjaman"
                                                            value="" />
                                                        <thead>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Name</th>
                                                                <th>Image</th>
                                                                <th>Jumlah</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="table-data">
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="text-center mt-4">
                                                <button type="button" class="btn btn-secondary mr-3"
                                                    data-bs-dismiss="modal">Kembali</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="modal fade" id="scanMemberModal" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-dark">Scan RFID</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" id="editMemberForm">
                                            @csrf
                                            <label for="">SILAHKAN SCAN RFID ANDA</label>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="modal fade" id="panjangModal" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-dark">Perpanjangan Peminjaman</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" id="panjangForm">
                                            @csrf
                                            <input type="hidden" id="panjang_id" name="panjang_id"
                                                value="" />
                                            <p>Apakah ingin mengajukan perpanjangan peminjaman?</p>
                                            <div class="text-center mt-4">
                                                <button type="button" class="btn btn-secondary mr-3"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Konfirmasi</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-guest.footer />
        </div>
        <div class="container mt-4">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</x-guest-layout>
<script src='https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).on('click', '.edit-btn', function() {
        let id = $(this).data('id');
        $('#editMemberModal').modal('show');
        $('#editMemberForm').trigger('reset');
        $('#table-data').empty();
        $('#id_peminjaman').val(id);
        $.ajax({
            url: '/anggota/pengembalian/edit/' + id,
            method: 'GET',
            success: function(data) {
                let tableData = '';
                for (let i = 0; i < data.length; i++) {
                    tableData += `
                    <tr>
                        <td>${i + 1}</td>
                        <td>${data[i].name}</td>
                        <td><img src="${data[i].image}" style="max-width: 50px; max-height: 50px;" class="img-thumbnail" data-full-image="${data[i].image}"></td>
                        <td>${data[i].jumlah_pinjam}</td>
                    </tr>
                `;
                }
                $('#table-data').html(tableData);
            }
        });
    });

    $(document).on('click', '.img-thumbnail', function() {
        let fullImage = $(this).data('full-image');
        Swal.fire({
            imageUrl: fullImage,
            imageHeight: 400,
            imageAlt: 'Image Preview',
            showConfirmButton: false
        });
    });

    $(document).ready(function() {
        $('.table').DataTable({
            "searching": true,
            "paging": true
        });
    });
    $(document).on('click', '.panjang-btn', function() {
        let id = $(this).data('id');
        $('#panjangModal').modal('show');
        $('#panjang_id').val(id);
    });

    $('#panjangForm').on('submit', function(e) {
        e.preventDefault();
        let id = $('#panjang_id').val();
        $.ajax({
            url: '/anggota/pengembalian/panjang/' + id,
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#panjangModal').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses',
                    text: response.message
                }).then(() => {
                    location.reload();
                });
            },
            error: function(xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Terjadi kesalahan saat mengajukan perpanjangan peminjaman.'
                });
            }
        });
    });
</script>
