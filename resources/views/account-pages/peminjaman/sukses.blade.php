<x-guest-layout>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <x-navbar-guest />
        <div class="pt-7 pb-4 bg-cover"
            style="background-image: url('../assets/img/history.png'); background-position: bottom;"></div>
        <div class="container my-3 py-3">
            <div class="table-responsive">
                <table class="table text-secondary text-center">
                    <thead>
                        <tr>
                            <th
                                class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                No Transaksi</th>
                            <th
                                class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                Nama Peminjam</th>
                            <th
                                class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                Tanggal Pinjam</th>
                            <th
                                class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                ID RFID</th>
                            <th
                                class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                Status</th>
                            <th
                                class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pinjam->isEmpty())
                            <tr>
                                <td colspan="7">TIDAK ADA DATA</td>
                            </tr>
                        @else
                            @foreach ($pinjam as $pjm)
                                <tr>
                                    <td class="text-left">{{ $pjm->id }}</td>
                                    <td class="text-left">{{ $pjm->name_user }}</td>
                                    <td class="text-left">{{ $pjm->tanggal_pinjam }}</td>
                                    <td class="text-left">{{ $pjm->id_card }}</td>
                                    <td class="text-center">
                                        <span
                                            class="badge badge-sm border border-success text-success bg-success">{{ 'Sukses' }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="mx-3 edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editMemberModal" data-id="{{ $pjm->id }}">
                                            <i class="fas fa-eye text-secondary"></i>
                                        </a>
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
            url: '/anggota/peminjaman-sukses/edit_sukses/' + id,
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
    // Fungsi untuk memperbesar gambar saat diklik
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
</script>
