<x-guest-layout>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <x-navbar-guest />
        <div class="pt-7 pb-6 bg-cover"
            style="background-image: url('../assets/img/bukuu.png'); background-position: bottom;"></div>
        <div class="container my-3 py-3">
            <section style="background-color: #eee;">
                <div class="container py-5">
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Nama Buku</label>
                                <input type="text" placeholder="Masukkan Nama Buku" class="form-control"
                                    id="name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="pengarang">Pengarang</label>
                                <select class="form-control" id="pengarang" name="pengarang">
                                    <option value="">Select Pengarang</option>
                                    @foreach ($pengarangs as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="penerbit">Penerbit</label>
                                <select class="form-control" id="penerbit" name="penerbit">
                                    <option value="">Select Penerbit</option>
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
                                                    class="card-img-top" alt="{{ $book->name }}" />
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between">
                                                        <p class="small">Penerbit</p>
                                                        <p class="small">
                                                            <a href="#!" class="text-muted"
                                                                id="penerbit">{{ $book->penerbit_name }}</a>
                                                        </p>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <p class="small">Pengarang</p>
                                                        <p class="small">
                                                            <a href="#!" class="text-muted"
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
                                                        <a href="#" class="btn btn-success"><i
                                                                class="fas fa-shopping-cart"></i>
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
    </div>
</x-guest-layout>
<script>
    const nameInput = document.getElementById('name');
    const pengarangInput = document.getElementById('pengarang');
    const penerbitInput = document.getElementById('penerbit');
    nameInput.addEventListener('input', filterData);
    pengarangInput.addEventListener('change', filterData);
    penerbitInput.addEventListener('change', filterData);

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
</script>
