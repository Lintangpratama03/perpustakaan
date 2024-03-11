<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">Kelola Pengarang</h5>
                                    <p class="mb-0 text-sm">
                                        Data Pengarang
                                    </p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#" class="btn btn-dark btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addPengarangModal">
                                        <i class="fas fa-user-plus me-2"></i> Tambah Pengarang
                                    </a>
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
                                            Nama</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Alamat</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Telepon</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($pengarang->isEmpty())
                                        <tr>
                                            <td colspan="7">TIDAK ADA DATA</td>
                                        </tr>
                                    @else
                                        @php $counter = 1 @endphp
                                        @foreach ($pengarang as $pg)
                                            <tr>
                                                <td class="text-left">{{ $counter }}</td>
                                                <td class="text-left">{{ $pg->name }}</td>
                                                <td class="text-left">{{ $pg->alamat }}</td>
                                                <td class="text-left">{{ $pg->telp }}</td>
                                                <td class="text-center">
                                                    <a href="#" class="mx-3 edit-btn" data-bs-toggle="modal"
                                                        data-bs-target="#editPengarangModal"
                                                        data-id="{{ $pg->id }}">
                                                        <i class="fas fa-edit text-secondary"></i>
                                                    </a>
                                                    <a href="#" class="mx-3 deleteIcon"
                                                        data-id="{{ $pg->id }}" data-name="{{ $pg->name }}">
                                                        <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            @php $counter++ @endphp
                                        @endforeach
                                    @endif
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="modal fade" id="addPengarangModal" tabindex="-1" role="dialog"
                    aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-dark">Form Data Pengarang</h3>
                                    </div>
                                    <div class="card-body">
                                        <form role="form text-left" id="addPengarangForm">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control"
                                                                placeholder="Name" name="name" aria-label="Name"
                                                                aria-describedby="name-addon">
                                                        </div>
                                                        <span class="text-danger error-name"
                                                            style="font-size: 0.8rem;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <div class="input-group mb-3">
                                                            <input type="alamat" class="form-control"
                                                                placeholder="alamat" name="alamat" aria-label="alamat"
                                                                aria-describedby="alamat-addon">
                                                        </div>
                                                        <span class="text-danger error-alamat"
                                                            style="font-size: 0.8rem;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Telepon</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control"
                                                                placeholder="telp" name="telp" aria-label="telp"
                                                                aria-describedby="telp-addon">
                                                        </div>
                                                        <span class="text-danger error-telp"
                                                            style="font-size: 0.8rem;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="add_Pengarang_btn"
                                                    class="btn btn-primary">Tambah
                                                    Pengarang</button>
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
                <div class="modal fade" id="editPengarangModal" tabindex="-1" role="dialog"
                    aria-labelledby="modal-form" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-body p-0">
                                <div class="card card-plain">
                                    <div class="card-header pb-0 text-left">
                                        <h3 class="font-weight-bolder text-dark">Form Data Pengarang</h3>
                                    </div>
                                    <div class="card-body">
                                        <form method="post" id="editPengarangForm">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <input type="hidden" name="id" id="id">
                                                    <div class="form-group">
                                                        <label>Nama</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control"
                                                                placeholder="Name" name="name" aria-label="Name"
                                                                aria-describedby="name-addon">
                                                        </div>
                                                        <span class="text-danger error-name"
                                                            style="font-size: 0.8rem;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Alamat</label>
                                                        <div class="input-group mb-3">
                                                            <input type="alamat" class="form-control"
                                                                placeholder="alamat" name="alamat"
                                                                aria-label="alamat" aria-describedby="alamat-addon">
                                                        </div>
                                                        <span class="text-danger error-alamat"
                                                            style="font-size: 0.8rem;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Telepon</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control"
                                                                placeholder="telp" name="telp" aria-label="telp"
                                                                aria-describedby="telp-addon">
                                                        </div>
                                                        <span class="text-danger error-telp"
                                                            style="font-size: 0.8rem;"></span>
                                                    </div>
                                                </div>
                                                <div class="text-center">
                                                    <div class="text-center">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" id="edit_Pengarang_bt"
                                                            class="btn btn-primary">Edit
                                                            Pengarang</button>
                                                    </div>
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
        $("#addPengarangForm").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#add_Pengarang_btn").text('Adding...');
            $.ajax({
                url: '{{ route('pengarang.store') }}',
                method: 'post',
                _token: '{{ csrf_token() }}',
                data: fd,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 200) {
                        Swal.fire(
                            'Added!',
                            'Pengarang Added Successfully!',
                            'success'
                        );
                        $("#addPengarangModal").modal('hide');
                        window.location.reload();
                    }
                    $("#add_Pengarang_btn").text('Add Pengarang');
                    $("#addPengarangModal").modal('hide');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $('.text-danger').text('');
                        $.each(errors, function(key, value) {
                            $('.error-' + key).text(value[0]);
                        });
                    }
                    $("#add_Pengarang_btn").text('Add Pengarang');
                }

            });
        });

        $("#editPengarangForm").submit(function(e) {
            e.preventDefault();
            let id = $('#id').val();
            const form = document.getElementById("editPengarangForm");
            const fd = new FormData(form);
            $("#edit_Pengarang_bt").text('Updating...');
            $.ajax({
                url: '/kelola-pengarang/update/' + id,
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
                            'Pengarang Updated Successfully!',
                            'success'
                        );
                        $("#editPengarangModal").modal('hide');
                        window.location.reload();
                    }
                    $("#edit_Pengarang_bt").text('Edit Pengarang');
                    $("#editPengarangModal").modal('hide');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $('.text-danger').text('');
                        $.each(errors, function(key, value) {
                            $('.error-' + key).text(value[0]);
                        });
                    }
                    $("#edit_Pengarang_bt").text('Edit Pengarang');
                }
            });
        });

        $(document).on('click', '.edit-btn', function() {
            let id = $(this).data('id');
            $('#editPengarangModal').modal('show');
            $('#editPengarangModal').trigger('reset');
            $('#id').val(id);

            $.ajax({
                url: '/kelola-pengarang/edit/' + id,
                method: 'GET',
                success: function(data) {
                    $('#editPengarangModal').find('input[name="name"]').val(data.name);
                    $('#editPengarangModal').find('input[name="alamat"]').val(data.alamat);
                    $('#editPengarangModal').find('input[name="telp"]').val(data.telp);
                }
            });
        });
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert deleting Pengarang: " + name,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let token = $('meta[name="csrf-token"]').attr(
                        'content');
                    $.ajax({
                        url: '/kelola-pengarang/delete/' + id,
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
