<x-app-layout>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">Kelola History Kembali</h5>
                                    <p class="mb-0 text-sm">
                                        Data History Kembali
                                    </p>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="">
                                @if (session('success'))
                                    <div class="alert alert-success" role="alert" id="alert">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger" role="alert" id="alert">
                                        {{ session('error') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table text-secondary text-center" id="table-oke">
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
                                            Tanggal Pinjam</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Tanggal Kembali</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Telat</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Total Denda</th>
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
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>TIDAK ADA DATA</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    @else
                                        @foreach ($pinjam as $pjm)
                                            <tr>
                                                <td class="text-center">{{ $pjm->id }}</td>
                                                <td class="text-center">{{ $pjm->name_user }}</td>
                                                <td class="text-center">{{ $pjm->tanggal_pinjam }}</td>
                                                <td class="text-center">{{ $pjm->tanggal_pengembalian }}</td>
                                                <td class="text-center">
                                                    @if ($pjm->telat == 0)
                                                        -
                                                    @else
                                                        {{ $pjm->telat }} Hari
                                                    @endif
                                                </td>
                                                <td class="text-center">Rp {{ $pjm->denda }}</td>
                                                <td class="text-center">
                                                    <span
                                                        class="badge badge-sm border border-success text-success bg-success">{{ 'Selesai' }}</span>
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
                    </div>
                </div>
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
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>ID RFID</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="rfid" aria-label="rfid"
                                                                        aria-describedby="rfid-addon" readonly>
                                                                </div>
                                                                <span class="text-danger error-rfid"
                                                                    style="font-size: 0.8rem;"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label>DATA PINJAM</label>
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
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Telat Hari</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="telat" aria-label="telat"
                                                                        aria-describedby="telat-addon" readonly>
                                                                </div>
                                                                <span class="text-danger error-telat"
                                                                    style="font-size: 0.8rem;"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Total Denda</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" class="form-control"
                                                                        name="denda" aria-label="denda"
                                                                        aria-describedby="denda-addon" readonly>
                                                                </div>
                                                                <span class="text-danger error-denda"
                                                                    style="font-size: 0.8rem;"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center mt-4">
                                                <button type="button" class="btn btn-secondary mr-3"
                                                    data-bs-dismiss="modal">Kembali</button>
                                                <button type="submit" id="edit_status"
                                                    class="btn btn-primary">Proses
                                                    Ajuan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-app.footer />
    </main>
</x-app-layout>
<script src='https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function() {
        $(document).on('click', '.edit-btn', function() {
            let id = $(this).data('id');
            $('#editMemberModal').modal('show');
            $('#editMemberForm').trigger('reset');
            $('#table-data').empty();
            $('#id_peminjaman').val(id);
            $.ajax({
                url: '/kelola-kembali-sukses/edit_sukses/' + id,
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
                    $telat = data[0].telat;
                    if ($telat > 0) {
                        $('#editMemberForm').find('input[name="telat"]').val(data[0].telat);
                    } else {
                        $('#editMemberForm').find('input[name="telat"]').val('Tidak telat');
                    }
                    $('#table-data').html(tableData);
                    $('#editMemberForm').find('input[name="denda"]').val(data[0].denda);
                    $('#editMemberForm').find('input[name="rfid"]').val(data[0].rfid);
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
            $('#table-oke').DataTable({
                "searching": true,
                "paging": true
            });
        });
    });
</script>
