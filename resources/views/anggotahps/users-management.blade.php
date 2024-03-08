<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">User Management</h5>
                                    <p class="mb-0 text-sm">
                                        Here you can manage users.
                                    </p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#" class="btn btn-dark btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addMemberModal">
                                        <i class="fas fa-user-plus me-2"></i> Add Member
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
                                <style>
                                    .table {
                                        overflow-y: auto;
                                    }
                                </style>
                                <thead>
                                    <tr>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            ID</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Photo</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Name</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Email</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Role</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Creation Date</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users->isEmpty())
                                        <tr>
                                            <td colspan="7">DATA TIDAK ADA</td>
                                        </tr>
                                    @else
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="text-left">{{ $user->id }}</td>
                                                <td class="text-left">
                                                    @if ($user->image)
                                                        <img src="{{ asset('storage/' . $user->image) }}"
                                                            alt="{{ $user->name }}" class="avatar avatar-sm me-3">
                                                    @else
                                                        <img src="{{ asset('assets/img/default-avatar.png') }}"
                                                            alt="{{ $user->name }}" class="avatar avatar-sm me-3">
                                                    @endif
                                                </td>
                                                <td class="text-left">{{ $user->name }}</td>
                                                <td class="text-left">{{ $user->email }}</td>
                                                <td class="text-center">
                                                    @if ($user->id_posisi == 2)
                                                        <span
                                                            class="badge badge-sm border border-success text-success bg-success">{{ 'Anggota RFID' }}</span>
                                                    @elseif ($user->id_posisi == 3)
                                                        <span
                                                            class="badge badge-sm border border-info text-info bg-info">{{ 'Anggota' }}</span>
                                                    @else
                                                        {{ 'N/A' }}
                                                    @endif
                                                </td>


                                                <td class="text-center">{{ $user->created_at->format('M d, Y') }}</td>
                                                <td class="text-center">
                                                    <a href="#" class="mx-3 edit-btn" data-bs-toggle="modal"
                                                        data-bs-target="#editMemberModal"
                                                        data-id="{{ $user->id }}">
                                                        <i class="fas fa-user-edit text-secondary"></i>
                                                    </a>
                                                    <a href="#" class="mx-3 deleteIcon"
                                                        data-id="{{ $user->id }}">
                                                        <i class="cursor-pointer fas fa-trash text-secondary"></i>
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
        </div>
        <div class="col-md-8">
            <div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-left">
                                    <h3 class="font-weight-bolder text-dark">Form Data Anggota</h3>
                                </div>
                                <div class="card-body">
                                    <form role="form text-left" id="addMemberForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Name"
                                                        name="name" aria-label="Name" aria-describedby="name-addon">
                                                    @error('name')
                                                        <span class="text-danger text-sm">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <label>Email</label>
                                                <div class="input-group mb-3">
                                                    <input type="email" class="form-control" placeholder="Email"
                                                        name="email" aria-label="Email"
                                                        aria-describedby="email-addon">
                                                </div>
                                                <label>Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" class="form-control" placeholder="Password"
                                                        name="password" aria-label="Password"
                                                        aria-describedby="password-addon">
                                                </div>
                                                <label>ID Posisi</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control"
                                                        placeholder="ID Posisi" name="id_posisi"
                                                        aria-label="ID Posisi" aria-describedby="id-posisi-addon">
                                                </div>
                                                <label>ID Card</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" placeholder="ID Card"
                                                        name="id_card" aria-label="ID Card"
                                                        aria-describedby="id-card-addon">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>NIS</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" placeholder="NIS"
                                                        name="nis" aria-label="NIS" aria-describedby="nis-addon">
                                                </div>
                                                <label>Username</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Username"
                                                        name="username" aria-label="Username"
                                                        aria-describedby="username-addon">
                                                </div>
                                                <label>HP</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="HP"
                                                        name="hp" aria-label="HP" aria-describedby="hp-addon">
                                                </div>
                                                <label>Alamat</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Alamat"
                                                        name="alamat" aria-label="Alamat"
                                                        aria-describedby="alamat-addon">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" id="add_anggota_btn" class="btn btn-primary">Add
                                                anggota</button>
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
            <div class="modal fade" id="editMemberModal" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-left">
                                    <h3 class="font-weight-bolder text-dark">Form Data Anggota</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" id="editMemberForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="hidden" name="id" id="id">
                                                <label>Name</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Name"
                                                        name="name" aria-label="Name"
                                                        aria-describedby="name-addon">
                                                </div>
                                                <label>Email</label>
                                                <div class="input-group mb-3">
                                                    <input type="email" class="form-control" placeholder="Email"
                                                        name="email" aria-label="Email"
                                                        aria-describedby="email-addon">
                                                </div>
                                                <label>Password</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" class="form-control"
                                                        placeholder="Password" name="password" aria-label="Password"
                                                        aria-describedby="password-addon">
                                                </div>
                                                <label>ID Posisi</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control"
                                                        placeholder="ID Posisi" name="id_posisi"
                                                        aria-label="ID Posisi" aria-describedby="id-posisi-addon">
                                                </div>
                                                <label>ID Card</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" placeholder="ID Card"
                                                        name="id_card" aria-label="ID Card"
                                                        aria-describedby="id-card-addon">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label>NIS</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" class="form-control" placeholder="NIS"
                                                        name="nis" aria-label="NIS" aria-describedby="nis-addon">
                                                </div>
                                                <label>Username</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Username"
                                                        name="username" aria-label="Username"
                                                        aria-describedby="username-addon">
                                                </div>
                                                <label>HP</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="HP"
                                                        name="hp" aria-label="HP" aria-describedby="hp-addon">
                                                </div>
                                                <label>Alamat</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" placeholder="Alamat"
                                                        name="alamat" aria-label="Alamat"
                                                        aria-describedby="alamat-addon">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Photo</label>
                                                    <div class="input-group mb-3">
                                                        <img src="" alt="User Photo" class="img-fluid"
                                                            style="max-width: 200px;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-center">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="edit_anggota_btn"
                                                    class="btn btn-primary">Edit
                                                    Anggota</button>
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
        <x-app.footer />
    </main>

</x-app-layout>
<script src='https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function() {
        $("#addMemberForm").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#add_anggota_btn").text('Adding...');
            $.ajax({
                url: '{{ route('usersHapus.store') }}',
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
                            'Anggota Added Successfully!',
                            'success'
                        );
                        $("#addMemberModal").modal('hide');
                        window.location.reload();
                    }
                    $("#add_anggota_btn").text('Add anggota');
                    $("#addMemberModal").modal('hide');
                }
            });
        });

        $("#editMemberForm").submit(function(e) {
            e.preventDefault();
            let id = $('#id').val();
            const form = document.getElementById("editMemberForm");
            const fd = new FormData(form);
            $("#edit_anggota_btn").text('Updating...');
            $.ajax({
                url: '/kelola-user-hapus/users-management/update/' + id,
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
                }
            });
        });

        $(document).on('click', '.edit-btn', function() {
            let id = $(this).data('id');
            $('#editMemberModal').modal('show');
            $('#editMemberModal').trigger('reset');
            $('#id').val(id);
            $.ajax({
                url: '/kelola-user-hapus/users-management/' + id + '/edit',
                method: 'GET',
                success: function(data) {
                    $('#editMemberModal').find('input[name="name"]').val(data.name);
                    $('#editMemberModal').find('input[name="email"]').val(data.email);
                    $('#editMemberModal').find('input[name="id_posisi"]').val(data
                        .id_posisi);
                    $('#editMemberModal').find('input[name="id_card"]').val(data.id_card);
                    $('#editMemberModal').find('input[name="nis"]').val(data.nis);
                    $('#editMemberModal').find('input[name="username"]').val(data.username);
                    $('#editMemberModal').find('input[name="hp"]').val(data.hp);
                    $('#editMemberModal').find('input[name="alamat"]').val(data.alamat);
                    $('#editMemberModal').find('img').attr('src', data.image);
                }
            });
        });
        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert deleting user: " + name,
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
                        url: '/kelola-user-hapus/users-management/delete/' + id,
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
