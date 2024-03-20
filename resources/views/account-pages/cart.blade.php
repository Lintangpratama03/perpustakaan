<x-guest-layout>
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
                                        <th>Product</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $total = 0 @endphp
                                    @if (session('cart'))
                                        @foreach (session('cart') as $id => $details)
                                            <tr rowId="{{ $id }}">
                                                <td data-th="Product">
                                                    <div class="row">
                                                        <div class="col-sm-3 hidden-xs"><img
                                                                src="{{ asset('assets/img/buku/' . $details['image']) }}"
                                                                class="card-img-top" />
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <h4 class="nomargin">{{ $details['name'] }}</h4>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td data-th="tahun_terbit">{{ $details['tahun_terbit'] }}</td>
                                                <td data-th="jumlah">{{ $details['jumlah'] }}</td>

                                                <td class="actions">
                                                    <a class="btn btn-outline-danger btn-sm delete-product"><i
                                                            class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-right">
                                            <a href="{{ url('/dashboard') }}" class="btn btn-primary"><i
                                                    class="fa fa-angle-left"></i> Continue
                                                Shopping</a>
                                            <button class="btn btn-danger">Checkout</button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
            </section>
            <x-guest.footer />
        </div>
    </div>
</x-guest-layout>
<script type="text/javascript">
    $(".edit-cart-info").change(function(e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ route('update.sopping.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("rowId"),
            },
            success: function(response) {
                window.location.reload();
            }
        });
    });

    $(".delete-product").click(function(e) {
        e.preventDefault();

        var ele = $(this);

        if (confirm("Do you really want to delete?")) {
            $.ajax({
                url: '{{ route('delete.cart.product') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: ele.parents("tr").attr("rowId")
                },
                success: function(response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
