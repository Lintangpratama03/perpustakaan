<x-app-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <x-app.navbar />
        <div class="px-5 py-4 container-fluid">
            <div class="mt-4 row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-0 text-left">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="">Kelola Buku</h5>
                                    <p class="mb-0 text-sm">Data Buku</p>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="#" class="btn btn-dark btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addBukuModal">
                                        <i class="fas fa-user-plus me-2"></i> Tambah Buku
                                    </a>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="searchName"
                                        placeholder="Cari Nama Buku">
                                </div>
                                <div class="col-md-3">
                                    <input type="text" class="form-control" id="searchRak"
                                        placeholder="Cari Rak Buku">
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
                                            ID Buku</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Photo</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Nama</th>
                                        <th
                                            class="text-left text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Rak</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Jumlah</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Tahun Terbit</th>
                                        <th
                                            class="text-center text-uppercase font-weight-bold bg-transparent border-bottom text-secondary">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($buku->isEmpty())
                                        <tr>
                                            <td colspan="7">TIDAK ADA DATA</td>
                                        </tr>
                                    @else
                                        @foreach ($buku as $book)
                                            <tr>
                                                <td class="text-left">{{ $book->id }}</td>

                                                <td class="text-left">
                                                    @if ($book->image)
                                                        <img src="{{ asset('assets/img/buku/' . $book->image) }}"
                                                            class="object-fit-cover border-radius-lg shadow-sm"
                                                            style="width: 50px; height: 50px;">
                                                    @else
                                                        <img src="{{ asset('assets/img/default-avatar.png') }}"
                                                            class="object-fit-cover border-radius-lg shadow-sm"
                                                            style="width: 50px; height: 50px;">
                                                    @endif
                                                </td>

                                                <td class="text-left">{{ $book->name_buku }}</td>
                                                <td class="text-left">{{ $book->kode_rak }}</td>
                                                <td class="text-left">{{ $book->jumlah }}</td>
                                                <td class="text-center">{{ $book->tahun_terbit }}</td>
                                                <td class="text-center">
                                                    <a href="#" class="mx-3 edit-btn" data-bs-toggle="modal"
                                                        data-bs-target="#editBukuModal" data-id="{{ $book->id }}">
                                                        <i class="fas fa-book text-secondary"></i>
                                                    </a>
                                                    <a href="#" class="mx-3 deleteIcon"
                                                        data-id="{{ $book->id }}"
                                                        data-name="{{ $book->name_buku }}">
                                                        <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            <div class="border-top py-3 px-3 d-flex align-items-center">
                                <button class="btn btn-sm btn-white d-sm-block d-none mb-0">Previous</button>
                                <nav aria-label="..." class="ms-auto">
                                    <ul class="pagination pagination-light mb-0">
                                        @if ($buku->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link font-weight-bold">
                                                    << </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link border-0 font-weight-bold"
                                                    href="{{ $buku->previousPageUrl() }}">
                                                    << </a>
                                            </li>
                                        @endif

                                        @foreach ($buku->getUrlRange(1, $buku->lastPage()) as $page => $url)
                                            <li class="page-item {{ $page == $buku->currentPage() ? 'active' : '' }}"
                                                aria-current="page">
                                                <a class="page-link font-weight-bold"
                                                    href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        @if ($buku->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link border-0 font-weight-bold"
                                                    href="{{ $buku->nextPageUrl() }}"> >> </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link font-weight-bold"> >> </span>
                                            </li>
                                        @endif
                                    </ul>
                                </nav>
                                <button class="btn btn-sm btn-white d-sm-block d-none mb-0 ms-auto">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="modal fade" id="addBukuModal" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-left">
                                    <h3 class="font-weight-bolder text-dark">Form Data Buku</h3>
                                </div>
                                <div class="card-body">
                                    <form role="form text-left" id="addBukuForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Name"
                                                            name="name" aria-label="Name"
                                                            aria-describedby="name-addon">
                                                    </div>
                                                    <span class="text-danger error-name"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tahun Terbit</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control"
                                                            placeholder="Tahun Terbit" name="tahun_terbit"
                                                            aria-label="Tahun_Terbit"
                                                            aria-describedby="tahun_terbit-addon" min="0">
                                                    </div>
                                                    <span class="text-danger error-tahun_terbit"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jumlah</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control"
                                                            placeholder="Jumlah" name="jumlah" aria-label="Jumlah"
                                                            aria-describedby="jumlah-addon" min="0">
                                                    </div>
                                                    <span class="text-danger error-jumlah"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>

                                                <div class="form-group">
                                                    <label for="image">Foto</label>
                                                    <input type="file" name="image" id="image"
                                                        accept="image/*" onchange="previewImage(event)"
                                                        class="form-control">
                                                    <span class="text-danger error-image"
                                                        style="font-size: 0.8rem;"></span>
                                                    <img id="image-preview" alt="image Preview"
                                                        style="max-width: 100px; max-height: 100px; margin-top: 5px;">
                                                </div>
                                                <script>
                                                    function previewImage(event) {
                                                        var reader = new FileReader();
                                                        var output = document.getElementById('image-preview');

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
                                                    <label>ISBN</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="isbn"
                                                            name="isbn" aria-label="isbn"
                                                            aria-describedby="isbn-addon">
                                                    </div>
                                                    <span class="text-danger error-isbn"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pengarang">Pengarang</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control" name="pengarang" id="pengarang">
                                                            <option value="">Pilih Pengarang</option>
                                                            @foreach ($pengarang as $p)
                                                                <option value="{{ $p->id }}">
                                                                    {{ $p->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span class="text-danger error-pengarang"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="penerbit">Penerbit</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control" name="penerbit" id="penerbit">
                                                            <option value="">Pilih Penerbit</option>
                                                            @foreach ($penerbit as $p)
                                                                <option value="{{ $p->id }}">
                                                                    {{ $p->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span class="text-danger error-penerbit"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>

                                                <div class="form-group">
                                                    <label>rak</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control" name="rak" id="rak">
                                                            <option value="">Pilih Rak</option>
                                                            @foreach ($rak as $p)
                                                                <option value="{{ $p->id }}">
                                                                    {{ $p->kode }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span class="text-danger error-rak"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" id="add_buku_btn" class="btn btn-primary">Add
                                                buku</button>
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
            <div class="modal fade" id="editBukuModal" tabindex="-1" role="dialog" aria-labelledby="modal-form"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-left">
                                    <h3 class="font-weight-bolder text-dark">Form Data buku</h3>
                                </div>
                                <div class="card-body">
                                    <form method="post" id="editBukuForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" name="id" id="id">
                                                    <label>Name</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Name"
                                                            name="name" aria-label="Name"
                                                            aria-describedby="name-addon">
                                                    </div>
                                                    <span class="text-danger error-name"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Tahun Terbit</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control"
                                                            placeholder="Tahun Terbit" name="tahun_terbit"
                                                            aria-label="Tahun_Terbit"
                                                            aria-describedby="tahun_terbit-addon" min="0">
                                                    </div>
                                                    <span class="text-danger error-tahun_terbit"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Jumlah</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" class="form-control"
                                                            placeholder="Jumlah" name="jumlah" aria-label="Jumlah"
                                                            aria-describedby="jumlah-addon" min="0">
                                                    </div>
                                                    <span class="text-danger error-jumlah"
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
                                                    <label>ISBN</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="isbn"
                                                            name="isbn" aria-label="isbn"
                                                            aria-describedby="isbn-addon">
                                                    </div>
                                                    <span class="text-danger error-isbn"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pengarang">Pengarang</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control" name="pengarang" id="pengarang">
                                                            <option value="">Pilih Pengarang</option>
                                                            @foreach ($pengarang as $p)
                                                                <option value="{{ $p->id }}">
                                                                    {{ $p->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span class="text-danger error-pengarang"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="penerbit">Penerbit</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control" name="penerbit" id="penerbit">
                                                            <option value="">Pilih Penerbit</option>
                                                            @foreach ($penerbit as $p)
                                                                <option value="{{ $p->id }}">
                                                                    {{ $p->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span class="text-danger error-penerbit"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>

                                                <div class="form-group">
                                                    <label>rak</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control" name="rak" id="rak">
                                                            <option value="">Pilih Rak</option>
                                                            @foreach ($rak as $p)
                                                                <option value="{{ $p->id }}">
                                                                    {{ $p->kode }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span class="text-danger error-rak"
                                                        style="font-size: 0.8rem;"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <div class="text-center">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" id="edit_buku_btn"
                                                    class="btn btn-primary">Edit
                                                    buku</button>
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
        $('#searchName').on('keyup', function() {
            var searchTerm = $(this).val().toLowerCase();
            $('tbody tr').each(function() {
                var bookName = $(this).find('td:nth-child(3)').text().toLowerCase();
                if (bookName.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Fungsi pencarian rak buku
        $('#searchRak').on('keyup', function() {
            var searchTerm = $(this).val().toLowerCase();
            $('tbody tr').each(function() {
                var rakName = $(this).find('td:nth-child(4)').text().toLowerCase();
                if (rakName.includes(searchTerm)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });




        $("#addBukuForm").submit(function(e) {
            e.preventDefault();
            const fd = new FormData(this);
            $("#add_buku_btn").text('Adding...');
            $.ajax({
                url: '{{ route('buku.store') }}',
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
                            'Buku Added Successfully!',
                            'success'
                        );
                        $("#addBukuModal").modal('hide');
                        window.location.reload();
                    }
                    $("#add_buku_btn").text('Add buku');
                    $("#addBukuModal").modal('hide');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $('.text-danger').text('');
                        $.each(errors, function(key, value) {
                            $('.error-' + key).text(value[0]);
                        });
                    }
                    $("#add_buku_btn").text('Add buku');
                }

            });
        });

        $("#editBukuForm").submit(function(e) {
            e.preventDefault();
            let id = $('#id').val();
            const form = document.getElementById("editBukuForm");
            const fd = new FormData(form);
            $("#edit_buku_btn").text('Updating...');
            $.ajax({
                url: '/kelola-buku/update/' + id,
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
                            'buku Updated Successfully!',
                            'success'
                        );
                        $("#editBukuModal").modal('hide');
                        window.location.reload();
                    }
                    $("#edit_buku_btn").text('Edit buku');
                    $("#editBukuModal").modal('hide');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        $('.text-danger').text('');
                        $.each(errors, function(key, value) {
                            $('.error-' + key).text(value[0]);
                        });
                    }
                    $("#edit_buku_btn").text('Edit buku');
                }
            });
        });

        $(document).on('click', '.edit-btn', function() {
            let id = $(this).data('id');
            $('#editBukuModal').modal('show');
            $('#editBukuForm').trigger('reset');
            $('#id').val(id);
            $('#image-preview-edit').attr('src', '');
            $('#image-preview-edit').hide();

            $.ajax({
                url: '/kelola-buku/edit/' + id,
                method: 'GET',
                success: function(data) {
                    $('#editBukuForm').find('input[name="name"]').val(data.name);
                    $('#editBukuForm').find('input[name="tahun_terbit"]').val(data
                        .tahun_terbit);
                    $('#editBukuForm').find('input[name="jumlah"]').val(data.jumlah);
                    $('#editBukuForm').find('input[name="isbn"]').val(data.isbn);
                    $('#editBukuForm').find('select[name="pengarang"]').val(data
                        .pengarang_id);
                    $('#editBukuForm').find('select[name="penerbit"]').val(data
                        .penerbit_id);
                    $('#editBukuForm').find('select[name="rak"]').val(data.rak_kode_rak);
                    if (data.image) {
                        $('#image-preview-edit').attr('src', data.image);
                        $('#image-preview-edit').show();
                    }
                }
            });
        });

        $(document).on('click', '.deleteIcon', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).data('name');
            Swal.fire({
                title: 'Apakah Kamu Yakin?',
                text: "Nama Buku yang ingin kamu hapus : " + name,
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
                        url: '/kelola-buku/delete/' + id,
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
