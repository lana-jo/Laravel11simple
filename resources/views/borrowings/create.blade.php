@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Peminjaman Barang</h1>

    <form action="{{ route('borrowings.store') }}" method="POST">
        @csrf

        <!-- Nama Customer -->
        <div class="form-group">
            <label for="customer_name">Nama Customer</label>
            <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
            @error('customer_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Pilih Barang -->
        <div class="form-group">
            <label for="item_id">Pilih Barang</label>
            <select name="item_id" id="item_id" class="form-control @error('item_id') is-invalid @enderror" required>
                <option value="">Pilih Barang</option>
                @foreach ($items as $item)
                    <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                        {{ $item->name }}
                    </option>
                @endforeach
            </select>
            @error('item_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tanggal Peminjaman -->
        <div class="form-group">
            <label for="borrowing_date">Tanggal Peminjaman</label>
            <input type="date" class="form-control @error('borrowing_date') is-invalid @enderror" id="borrowing_date" name="borrowing_date" value="{{ old('borrowing_date') }}" required>
            @error('borrowing_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan Peminjaman</button>
    </form>
</div>
@endsection
