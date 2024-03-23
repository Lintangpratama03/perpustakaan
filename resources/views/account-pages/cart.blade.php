<x-guest-layout>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <x-navbar-guest />
        <div class="pt-7 pb-6 bg-cover"
            style="background-image: url('../assets/img/bukuuu.png'); background-position: bottom;"></div>
        <div class="container my-3 py-3">
            <section style="background-color: #eee;">
                <div class="container py-5">
                    <div class="row mb-4">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-9">
                            <table id="cart" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID Buku</th>
                                        <th>Product</th>
                                        <th>Tahun Terbit</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0 @endphp
                                    @if (session('cart'))
                                        @foreach (session('cart') as $id => $details)
                                            <tr rowId="{{ $id }}">
                                                <td data-th="id_buku">{{ $details['id'] }}</td>
                                                <td data-th="Product">
                                                    <div class="row">
                                                        <div class="col-sm-3 hidden-xs"><img
                                                                src="{{ asset('assets/img/buku/' . $details['image']) }}"
                                                                class="card-img-top" /></div>
                                                        <div class="col-sm-9">
                                                            <h4 class="nomargin">{{ $details['name'] }}</h4>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td data-th="tahun_terbit">{{ $details['tahun_terbit'] }}</td>
                                                <td data-th="jumlah">{{ $details['jumlah'] }}</td>
                                                <td class="actions">
                                                    <a class="btn btn-outline-danger btn-sm delete-product"
                                                        data-id="{{ $id }}"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right">
                                            <a href="{{ url('/anggota/buku') }}" class="btn btn-primary"><i
                                                    class="fa fa-angle-left"></i> Kembali</a>
                                            <button class="btn btn-danger" id="checkout">Pinjam</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <x-guest.footer />
        </div>
    </div>
</x-guest-layout>

<script src='https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js'></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    $(document).on('click', '.delete-product', function(e) {
        e.preventDefault();
        let id = $(this).data('id');
        Swal.fire({
            title: 'Apakah Kamu Yakin ingin menghapus data ini?',
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
                    url: '/anggota/shopping-cart/delete-cart-product/' + id,
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
    $("#checkout").click(function(e) {
        e.preventDefault();

        var confirmCheckout = confirm("Apakah anda yakin ingin checkout?");

        if (confirmCheckout) {
            var ids = [];
            $('#cart tbody tr').each(function() {
                ids.push($(this).find('td[data-th="id_buku"]').text());
            });

            $.ajax({
                url: '{{ route('checkout') }}',
                method: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    ids: ids
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Berhasil!',
                        text: response.message,
                        icon: 'success',
                        timer: 1500,
                        timerProgressBar: true,
                        allowOutsideClick: false,
                        showConfirmButton: false
                    }).then(() => {
                        window.location.href = '{{ url('/anggota/buku') }}';
                    });
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>
