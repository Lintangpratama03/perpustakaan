<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">Kelola Ajuan Kembali</h5>
                                    <p class="mb-0 text-sm">
                                        Data Ajuan Kembali
                                    </p>
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
                            <table class="table text-secondary text-center">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            No</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Tanggal Pinjam</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Tenggat Kembali</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            ID RFID</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Denda</th>
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
                                                <td class="text-center">{{ $pjm->id }}</td>
                                                <td class="text-center">{{ $pjm->tanggal_pinjam }}</td>
                                                <td class="text-center">{{ $pjm->tenggat_kembali }}</td>
                                                <td class="text-center">{{ $pjm->id_card }}</td>
                                                <td class="text-center">
                                                    @if ($pjm->status == 1)
                                                        <span
                                                            class="badge badge-sm border border-danger text-danger bg-danger">{{ 'Belum Dicek' }}</span>
                                                    @elseif ($pjm->status == 2)
                                                        <span
                                                            class="badge badge-sm border border-warning text-warning bg-warning">{{ 'Proses Scan' }}</span>
                                                    @else
                                                        {{ 'N/A' }}
                                                    @endif
                                                </td>
                                                <td class="text-center">Rp {{ $pjm->denda }}</td>
                                                <td class="text-center">
                                                    @if ($pjm->status == 3)
                                                        <a href="#" class="mx-3 edit-btn" data-bs-toggle="modal"
                                                            data-bs-target="#editMemberModal"
                                                            data-id="{{ $pjm->id }}">
                                                            <i class="fas fa-eye text-secondary"></i>
                                                        </a>
                                                    @elseif ($pjm->status == 4)
                                                        <a href="#" class="mx-3 scan-btn" data-bs-toggle="modal"
                                                            data-bs-target="#scanMemberModal"
                                                            data-id="{{ $pjm->id }}">
                                                            <i class="fa fa-id-badge text-secondary"></i>
                                                        </a>
                                                    @else
                                                        {{ 'N/A' }}
                                                    @endif
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
                                                <button type="submit" id="edit_status" class="btn btn-primary">Proses
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
        $("#editMemberForm").submit(function(e) {
            e.preventDefault();
            let id = $('#id_peminjaman').val();
            // console.log(id);
            const form = document.getElementById("editMemberForm");
            const fd = new FormData(form);
            $("#edit_status").text('Updating...');
            $.ajax({
                url: '/kelola-pinjam-ajuan/update/' + id,
                method: 'POST',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    if (response.status == 200) {
                        Swal.fire(
                            'Updated!',
                            'Peminjaman Updated Successfully!',
                            'success'
                        );
                        $("#editMemberModal").modal('hide');
                        window.location.reload();
                    }
                    $("#edit_status").text('Edit peminjaman');
                    $("#editMemberModal").modal('hide');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $('.text-danger').text('');
                        $.each(errors, function(key, value) {
                            $('.error-' + key).text(value[0]);
                        });
                    }
                    $("#edit_status").text('Edit peminjaman');
                }
            });
        });

        $(document).on('click', '.edit-btn', function() {
            let id = $(this).data('id');
            $('#editMemberModal').modal('show');
            $('#editMemberForm').trigger('reset');
            $('#table-data').empty();
            $('#id_peminjaman').val(id);
            $.ajax({
                url: '/kelola-pinjam-ajuan/edit/' + id,
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
    });
</script>