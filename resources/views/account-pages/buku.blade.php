<x-guest-layout>

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
        </script>
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    </head>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <x-navbar-guest />
        <div class="pt-7 pb-6 bg-cover"
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
                            <div class="form-group">
                                <input type="text" placeholder="Masukkan Nama Buku" class="form-control"
                                    id="name" name="name">
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="pengarang" name="pengarang">
                                    <option value="">-- Pilih Pengarang -- </option>
                                    @foreach ($pengarangs as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="penerbit" name="penerbit">
                                    <option value="">-- Pilih Penerbit --</option>
                                    @foreach ($penerbits as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
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
                                                        <a href="{{ route('addbook.to.cart', $book->id) }}"
                                                            class="btn btn-outline-danger"><i class="fas fa-plus"></i>
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
        const nameInput = document.getElementById('name');
        const pengarangInput = document.getElementById('pengarang');
        const penerbitInput = document.getElementById('penerbit');
        const cartCountElement = document.getElementById('cart-count');
        let cartItems = [];

        nameInput.addEventListener('input', filterData);
        pengarangInput.addEventListener('change', filterData);
        penerbitInput.addEventListener('change', filterData);

        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        addToCartButtons.forEach(button => {
            button.addEventListener('click', addToCart);
        });

        function filterData() {
            const nameValue = nameInput.value.toLowerCase();
            const pengarangValue = pengarangInput.value;
            const penerbitValue = penerbitInput.value;
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                const name = card.querySelector('.lead').textContent.toLowerCase();
                const pengarang = card.querySelector('#pengarang').textContent;
                const penerbit = card.querySelector('#penerbit').textContent;
                const shouldShow = name.includes(nameValue) && (pengarangValue == '' || pengarang.includes(
                    pengarangValue)) && (penerbitValue == '' || penerbit.includes(penerbitValue));
                card.style.display = shouldShow ? 'block' : 'none';
            });
        }

        function addToCart(event) {
            event.preventDefault();
            const bookId = event.target.dataset.bookId;
            if (!cartItems.includes(bookId)) {
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin menambahkan buku ini ke keranjang?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Tambahkan',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        cartItems.push(bookId);
                        updateCartCount();
                        window.location.href = `{{ route('addbook.to.cart', $book->id) }}`;
                        Swal.fire({
                            title: 'Berhasil!',
                            text: 'Buku telah ditambahkan ke keranjang',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }
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
    </script>
</x-guest-layout>
