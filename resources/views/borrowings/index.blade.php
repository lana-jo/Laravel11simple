@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Peminjaman</h1>

    <!-- Tombol Tambah Peminjaman Baru -->
    <a href="{{ route('borrowings.create') }}" class="btn btn-primary mb-4">Tambah Peminjaman Baru</a>

    <!-- Tabel Daftar Peminjaman -->
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
                    <td>  @if($borrowing->status === 'borrowed') <!-- Menampilkan jika barang masih dipinjam -->
                            <span class="badge badge-warning">Barang Masih Dipinjam</span>
                        @else
                            <span class="badge badge-success">Sudah Dikembalikan</span>
                        @endif</td>
                    <td>
                      

                        <a href="{{ route('borrowings.edit', $borrowing->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('borrowings.destroy', $borrowing->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        <div class="alert alert-info">Belum ada peminjaman barang.</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
