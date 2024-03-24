<x-guest-layout>
    <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
        <x-navbar-guest />
        <div class="pt-7 pb-6 bg-cover"
            style="background-image: url('../assets/img/pinjam.png'); background-position: bottom;"></div>
        <div class="container my-3 py-3">
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
                                                class="badge badge-sm border border-warning text-warning bg-warning">{{ 'Proses' }}</span>
                                        @else
                                            {{ 'N/A' }}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="#" class="mx-3 edit-btn" data-bs-toggle="modal"
                                            data-bs-target="#editMemberModal" data-id="{{ $pjm->id }}">
                                            <i class="fas fa-eye text-secondary"></i>
                                        </a>
                                        <a href="#" class="mx-3 deleteIcon" data-id="{{ $pjm->id }}"
                                            data-name="{{ $pjm->name }}">
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
</x-guest-layout>
