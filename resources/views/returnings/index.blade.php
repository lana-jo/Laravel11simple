@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Pengembalian Barang</h1>

    <!-- Tabel Daftar Pengembalian -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Customer</th>
                <th>Barang</th>
                <th>Tanggal Peminjaman</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($borrowings as $borrowing)
                <tr>
                    <td>{{ $borrowing->id }}</td>
                    <td>{{ $borrowing->customer_name }}</td>
                    <td>{{ $borrowing->item->name ?? 'Tidak Ada Barang' }}</td> <!-- Menampilkan nama barang -->
                    <td>{{ $borrowing->borrowing_date }}</td>
                    <td>
                         @if($borrowing->status === 'borrowed') <!-- Menampilkan jika barang masih dipinjam -->
                            <span class="badge badge-warning">Barang Masih Dipinjam</span>
                        @else
                            <span class="badge badge-success">Sudah Dikembalikan</span>
                        @endif
                    </td>
                    <td>
                        @if($borrowing->status == 'borrowed') <!-- Menampilkan tombol pengembalian jika status masih 'borrowed' -->
                            <form action="{{ route('returnings.return', $borrowing->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Kembalikan</button>
                            </form>
                        @else
                            <span class="badge badge-success">Sudah Dikembalikan</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        <div class="alert alert-info">Belum ada barang yang dapat dikembalikan.</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
