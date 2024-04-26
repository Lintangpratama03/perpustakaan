<x-guest-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <x-navbar-guest />
        <div class="pt-7 pb-4 bg-cover"
            style="background-image: url('../assets/img/bukuu.png'); background-position: bottom;"></div>
        <div class="container my-3 py-3">
            <div class="d-flex justify-content-end mb-3">
                <a class="btn btn-outline-dark" href="{{ route('shopping.cart') }}">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i> Keranjang <span
                        class="badge text-bg-danger">{{ count((array) session('cart')) }}</span>
                </a>
            </div>
            <section style="background-color: #eee;">
                <div class="container py-5">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label for="">FILTER</label>
                            <form action="{{ route('buku-anggota') }}" method="GET">
                                <div class="form-group">
                                    <input type="text" placeholder="Masukkan Nama Buku" class="form-control"
                                        name="name" value="{{ request()->input('name') }}">
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="pengarang">
                                        <option value="">-- Pilih Pengarang --</option>
                                        @foreach ($pengarangs as $id => $name)
                                            <option value="{{ $id }}"
                                                {{ request()->input('pengarang') == $id ? 'selected' : '' }}>
                                                {{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="penerbit">
                                        <option value="">-- Pilih Penerbit --</option>
                                        @foreach ($penerbits as $id => $name)
                                            <option value="{{ $id }}"
                                                {{ request()->input('penerbit') == $id ? 'selected' : '' }}>
                                                {{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="rak">
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach ($rak as $id => $name)
                                            <option value="{{ $id }}"
                                                {{ request()->input('rak') == $id ? 'selected' : '' }}>
                                                {{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <button type="button" class="btn btn-secondary clear-filters-btn">Clear
                                    Filters</button>
                            </form>
                        </div>
                        <div class="col-md-9">
                            @foreach ($buku->chunk(3) as $chunk)
                                <div class="row mb-4">
                                    @foreach ($chunk as $book)
                                        <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                                            <div class="card">
                                                <div class="d-flex justify-content-between p-3">
                                                    <p class="lead mb-0">{{ $book->name }}</p>
                                                    <div class="bg-info rounded-circle d-flex align-items-center justify-content-center shadow-1-strong"
                                                        style="width: 35px; height: 35px;">
                                                        <p class="text-white mb-0 small">{{ $book->rak_kode }}</p>
                                                    </div>
                                                </div>
                                                <img src="{{ asset('assets/img/buku/' . $book->image) }}"
                                                    class="card-img-top" alt="{{ $book->name }}"
                                                    style="height: 200px; object-fit: cover;" />
                                                <div id="image-overlay" class="image-overlay">
                                                    <span class="close-btn">&times;</span>
                                                    <img id="full-image" src="" alt="">
                                                </div>
                                                <style>
                                                    .image-overlay {
                                                        display: none;
                                                        position: fixed;
                                                        z-index: 9999;
                                                        left: 0;
                                                        top: 0;
                                                        width: 100%;
                                                        height: 100%;
                                                        background-color: rgba(0, 0, 0, 0.9);
                                                        overflow: auto;
                                                        text-align: center;
                                                    }

                                                    .image-overlay img {
                                                        max-width: 90%;
                                                        max-height: 90%;
                                                        margin: auto;
                                                        display: block;
                                                        position: absolute;
                                                        top: 50%;
                                                        left: 50%;
                                                        transform: translate(-50%, -50%);
                                                    }

                                                    .close-btn {
                                                        position: absolute;
                                                        top: 15px;
                                                        right: 35px;
                                                        color: #f1f1f1;
                                                        font-size: 40px;
                                                        font-weight: bold;
                                                        transition: 0.3s ease;
                                                    }

                                                    .close-btn:hover,
                                                    .close-btn:focus {
                                                        color: #bbb;
                                                        text-decoration: none;
                                                        cursor: pointer;
                                                    }
                                                </style>
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <p class="small">Penerbit</p>
                                                        <p class="small">
                                                            <a class="text-muted"
                                                                id="penerbit">{{ $book->penerbit_name }}</a>
                                                        </p>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <p class="small">Pengarang</p>
                                                        <p class="small">
                                                            <a class="text-muted"
                                                                id="pengarang">{{ $book->pengarang_name }}</a>
                                                        </p>
                                                    </div>

                                                    <div class="d-flex justify-content-between mb-3">
                                                        <h5 class="mb-0">{{ $book->rak_name }}</h5>
                                                        <h5 class="text-dark mb-0">{{ $book->tahun_terbit }}</h5>
                                                    </div>

                                                    <div class="d-flex justify-content-between mb-2">
                                                        <p class="text-muted mb-0">Stok: <span
                                                                class="fw-bold">{{ $book->jumlah }}</span></p>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <a href="#" class="btn btn-primary"><i
                                                                class="fas fa-eye"></i>
                                                            Lihat</a>
                                                        <a class="btn btn-outline-danger add-cart"><i
                                                                class="fas fa-plus" data-id="{{ $book->id }}"></i>
                                                            Keranjang</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
            </section>
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
    <script src='https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const cartCountElement = document.getElementById('cart-count');
        let cartItems = [];

        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', addToCart);
        });

        $(document).on('click', '.add-cart', function(e) {
            e.preventDefault();
            let id = $(this).find('i').data('id');
            console.log(id);

            // Cek apakah pengguna sudah login atau belum
            @auth
            // Pengguna sudah login, tampilkan konfirmasi SweetAlert2
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menambahkan buku ini ke keranjang?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Tambahkan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    addBookToCart(id);
                }
            });
        @else
            // Pengguna belum login, tampilkan pesan "Silahkan login terlebih dahulu"
            Swal.fire({
                title: 'Oops!',
                text: 'Silahkan login terlebih dahulu untuk menambahkan buku ke keranjang.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
        @endauth
        });

        function addBookToCart(id) {
            let token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/anggota/buku/add-book/' + id,
                method: 'GET',
                data: {
                    _token: token
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Berhasil Masuk Keranjang!',
                        text: response.message,
                        icon: 'success',
                        timer: 1000,
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        showConfirmButton: false
                    }).then(() => {
                        $("#deleteModal").modal('hide');
                        window.location.reload();
                    });
                }
            });
            cartItems.push(id);
            updateCartCount();
        }



        function updateCartCount() {
            cartCountElement.textContent = cartItems.length;
        }

        function showSuccessNotification(message) {

        }

        const imageOverlay = document.getElementById('image-overlay');
        const fullImage = document.getElementById('full-image');
        const closeBtn = document.querySelector('.close-btn');

        const cardImages = document.querySelectorAll('.card-img-top');
        cardImages.forEach(image => {
            image.addEventListener('click', () => {
                fullImage.src = image.src;
                imageOverlay.style.display = 'block';
            });
        });

        closeBtn.addEventListener('click', () => {
            imageOverlay.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === imageOverlay) {
                imageOverlay.style.display = 'none';
            }
        });

        $(document).ready(function() {
            $('.clear-filters-btn').click(function() {
                // Mengosongkan nilai-nilai filter
                $('input[name="name"]').val('');
                $('select[name="pengarang"]').val('');
                $('select[name="penerbit"]').val('');
                $('select[name="rak"]').val('');

                // Mengirim ulang permintaan form
                $('form').submit();
            });
        });
    </script>
</x-guest-layout>
