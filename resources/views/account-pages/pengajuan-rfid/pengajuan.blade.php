<x-guest-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-navbar-guest />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card">
                        <div class="pb-0 card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">Riwayat Pengajuan Kartu RFID</h5>
                                    <p class="mb-0 text-sm">
                                        Data Ajuan
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
                                            NIS</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Photo</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Nama</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Email</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Status</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Tanggal Daftar</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users->isEmpty())
                                        <tr>
                                            <td colspan="7">TIDAK ADA DATA</td>
                                        </tr>
                                    @else
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="text-left">{{ $user->nis }}</td>
                                                <td class="text-left">
                                                    @if ($user->image)
                                                        <img src="{{ asset('assets/img/foto-profil/' . $user->image) }}"
                                                            class="object-fit-cover border-radius-lg shadow-sm"
                                                            style="width: 50px; height: 50px;">
                                                    @else
                                                        <img src="{{ asset('assets/img/default-avatar.png') }}"
                                                            class="object-fit-cover border-radius-lg shadow-sm"
                                                            style="width: 50px; height: 50px;">
                                                    @endif
                                                </td>

                                                <td class="text-left">{{ $user->name }}</td>
                                                <td class="text-left">{{ $user->email }}</td>
                                                <td class="text-center">
                                                    @if ($user->permintaan == 0)
                                                        <span
                                                            class="badge badge-sm border border-danger text-danger bg-danger">{{ 'Belum Mengajukan' }}</span>
                                                    @elseif ($user->permintaan == 1)
                                                        <span
                                                            class="badge badge-sm border border-warning text-warning bg-warning">{{ 'Proses' }}</span>
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
            <div class="modal fade" id="editMemberModal" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-left">
                                    <h3 class="font-weight-bolder text-dark">Form Data Anggota</h3>
                                    <h6 class="font-weight-bolder text-dark">*isi dengan benar</h6>
                                </div>
                                <div class="card-body">
                                    <form method="post" id="editMemberForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="hidden" name="id" id="id">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Name"
                                                            name="name" aria-label="Name"
                                                            aria-describedby="name-addon" readonly>
                                                    </div>
                                                    <span class="text-danger error-name"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                                <div class="form-group d-none">
                                                    <label>Email</label>
                                                    <div class="input-group mb-3">
                                                        <input type="email" class="form-control" placeholder="Email"
                                                            name="email" aria-label="Email"
                                                            aria-describedby="email-addon">
                                                    </div>
                                                    <span class="text-danger error-email"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                                <div class="form-group d-none">
                                                    <label>Password</label>
                                                    <div class="input-group mb-3">
                                                        <input type="password" class="form-control"
                                                            placeholder="Password" name="password"
                                                            aria-label="Password" aria-describedby="password-addon">
                                                    </div>
                                                    <span class="text-danger error-password"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                                <div class="form-group d-none">
                                                    <label for="image">Foto</label>
                                                    <input type="file" name="image" id="image"
                                                        accept="image/*" onchange="previewImage1(event)"
                                                        class="form-control">
                                                    <span class="text-danger error-image"
                                                        style="font-size: 0.8rem;"></span>
                                                    <img id="image-preview-edit" alt="image Preview"
                                                        style="max-width: 100px; max-height: 100px; margin-top: 5px;">
                                                </div>
                                                <script>
                                                    function previewImage1(event) {
                                                        var reader = new FileReader();
                                                        var output = document.getElementById('image-preview-edit');

                                                        reader.onload = function() {
                                                            output.src = reader.result;
                                                            output.style.display = 'block';
                                                        }

                                                        reader.readAsDataURL(event.target.files[0]);
                                                    }
                                                </script>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>NIS</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control" placeholder="NIS"
                                                            name="nis" aria-label="NIS"
                                                            aria-describedby="nis-addon">
                                                    </div>
                                                    <span class="text-danger error-nis"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                                <div class="form-group d-none">
                                                    <label>Username</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control"
                                                            placeholder="Username" name="username"
                                                            aria-label="Username" aria-describedby="username-addon">
                                                    </div>
                                                    <span class="text-danger error-username"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                                <div class="form-group d-none">
                                                    <label>HP</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="HP"
                                                            name="hp" aria-label="HP"
                                                            aria-describedby="hp-addon">
                                                    </div>
                                                    <span class="text-danger error-hp"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                                <div class="form-group d-none">
                                                    <label>Alamat</label>
                                                    <div class="input-group mb-3">
                                                        <textarea class="form-control" placeholder="Alamat" name="alamat"></textarea>
                                                    </div>
                                                    <span class="text-danger error-alamat"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-center">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="edit_anggota_btn"
                                                    class="btn btn-success">Konfirmasi</button>
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
        <x-guest.footer />
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
                    url: '/anggota/pengajuan/update/' + id,
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
                $('#editMemberModal').trigger('reset');
                $('#id').val(id);
                $('#image-preview-edit').attr('src', '');
                $('#image-preview-edit').hide();

                $.ajax({
                    url: '/anggota/pengajuan/' + id + '/edit',
                    method: 'GET',
                    success: function(data) {
                        $('#editMemberModal').find('input[name="name"]').val(data.name);
                        $('#editMemberModal').find('input[name="email"]').val(data.email);
                        $('#editMemberModal').find('input[name="id_posisi"]').val(data
                            .id_posisi);
                        $('#editMemberModal').find('input[name="password"]').val(data.password);
                        $('#editMemberModal').find('input[name="nis"]').val(data.nis);
                        $('#editMemberModal').find('input[name="username"]').val(data.username);
                        $('#editMemberModal').find('input[name="hp"]').val(data.hp);
                        $('#editMemberModal').find('textarea[name="alamat"]').val(data.alamat);
                        if (data.image) {
                            $('#image-preview-edit').attr('src', data.image);
                            $('#image-preview-edit').show();
                        }
                    }
                });
            });
        });
    </script>
