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
                                    <h5 class="">Kelola Ajuan Peminjaman</h5>
                                    <p class="mb-0 text-sm">
                                        Data Ajuan Peminjaman
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
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            No</th>
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
                                                    @if ($pjm->status == 1)
                                                        <span
                                                            class="badge badge-sm border border-danger text-danger bg-danger">{{ 'Belum Dicek' }}</span>
                                                    @elseif ($pjm->status == 2)
                                                        <span
                                                            class="badge badge-sm border border-warning text-warning bg-warning">{{ 'Pending' }}</span>
                                                    @else
                                                        {{ 'N/A' }}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="mx-3 edit-btn" data-bs-toggle="modal"
                                                        data-bs-target="#editMemberModal" data-id="{{ $pjm->id }}">
                                                        <i class="fas fa-eye text-secondary"></i>
                                                    </a>
                                                    <a href="#" class="mx-3 deleteIcon"
                                                        data-id="{{ $pjm->id }}"
                                                        data-name="{{ $pjm->name_user }}">
                                                        <i
                                                            class="cursor-pointer
                                                        fas fa-trash text-secondary"></i>
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
                                        <h3 class="font-weight-bolder text-dark">Form Data Buku Yang Dipinjam</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" id="editMemberForm">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6" id="table-data">
                                                </div>
                                            </div>
                                            <div class="text-center mt-4">
                                                <button type="button" class="btn btn-secondary mr-3"
                                                    data-bs-dismiss="modal">Kembali</button>
                                                <button type="submit" id="edit_anggota_btn"
                                                    class="btn btn-primary">Proses Ajuan</button>
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
        $("#editMemberForm").submit(function(e) {
            e.preventDefault();
            let id = $('#id').val();
            const form = document.getElementById("editMemberForm");
            const fd = new FormData(form);
            $("#edit_anggota_btn").text('Updating...');
            $.ajax({
                url: '/kelola-user-users/users-management/update/' + id,
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
                            'Anggota Updated Successfully!',
                            'success'
                        );
                        $("#editMemberModal").modal('hide');
                        window.location.reload();
                    }
                    $("#edit_anggota_btn").text('Edit anggota');
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
                    $("#edit_anggota_btn").text('Edit Anggota');
                }
            });
        });

        $(document).on('click', '.edit-btn', function() {
            let id = $(this).data('id');
            $('#editMemberModal').modal('show');
            $('#editMemberForm').trigger('reset');

            $.ajax({
                url: '/kelola-pinjam-ajuan/edit/' + id,
                method: 'GET',
                success: function(data) {
                    let tableData = '';
                    for (let i = 0; i < data.length; i++) {
                        tableData += `
                            <div class="row mb-3">
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <strong>No:</strong> ${i + 1}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <strong>Nama:</strong> ${data[i].name}
                                </div>
                                <div class="col-md-4">
                                    <img src="${data[i].image}" style="max-width: 100px; max-height: 100px;">
                                </div>
                            </div>
                        `;
                    }
                    $('#table-data').html(tableData);
                }
            });
        });

        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Nama user yang ingin kamu hapus : " + name,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Iya, Saya Yakin!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let token = $('meta[name="csrf-token"]').attr(
                        'content');
                    $.ajax({
                        url: '/kelola-user-users/users-management/delete/' + id,
                        method: 'POST',
                        data: {
                            _token: token
                        },
                        success: function(response) {
                            Swal.fire({
                                title: 'Deleted!',
                                text: response.message,
                                icon: 'success',
                                timer: 1500,
                                timerProgressBar: true,
                                allowOutsideClick: false,
                                showConfirmButton: false
                            }).then(() => {
                                $("#deleteModal").modal('hide');
                                window.location.reload();
                            });
                        }
                    });
                }
            });
        });
    });
</script>
