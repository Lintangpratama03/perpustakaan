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
                                                <td class="text-left">{{ $pjm->name }}</td>
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
                                                        data-id="{{ $pjm->id }}" data-name="{{ $pjm->name }}">
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
                                        <h3 class="font-weight-bolder text-dark">Form Data Anggota</h3>
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
                                                            <input type="text" class="form-control"
                                                                placeholder="Name" name="name" aria-label="Name"
                                                                aria-describedby="name-addon">
                                                        </div>
                                                        <span class="text-danger error-name"
                                                            style="font-size: 0.8rem;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email</label>
                                                        <div class="input-group mb-3">
                                                            <input type="email" class="form-control"
                                                                placeholder="Email" name="email" aria-label="Email"
                                                                aria-describedby="email-addon">
                                                        </div>
                                                        <span class="text-danger error-email"
                                                            style="font-size: 0.8rem;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Password</label>
                                                        <div class="input-group mb-3">
                                                            <input type="password" class="form-control"
                                                                placeholder="Password" name="password"
                                                                aria-label="Password" aria-describedby="password-addon">
                                                        </div>
                                                        <span class="text-danger error-password"
                                                            style="font-size: 0.8rem;"></span>
                                                    </div>
                                                    <div class="form-group">
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
                                                            <input type="number" class="form-control"
                                                                placeholder="NIS" name="nis" aria-label="NIS"
                                                                aria-describedby="nis-addon">
                                                        </div>
                                                        <span class="text-danger error-nis"
                                                            style="font-size: 0.8rem;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control"
                                                                placeholder="Username" name="username"
                                                                aria-label="Username"
                                                                aria-describedby="username-addon">
                                                        </div>
                                                        <span class="text-danger error-username"
                                                            style="font-size: 0.8rem;"></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>HP</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control"
                                                                placeholder="HP" name="hp" aria-label="HP"
                                                                aria-describedby="hp-addon">
                                                        </div>
                                                        <span class="text-danger error-hp"
                                                            style="font-size: 0.8rem;"></span>
                                                    </div>
                                                    <div class="form-group">
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
        </div>
        <x-app.footer />
    </main>
</x-app-layout>
