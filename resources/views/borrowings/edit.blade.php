
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-lg rounded-lg mb-4">
        <div class="card-header bg-gradient-primary text-white py-3">
            <h1 class="h3 mb-0 text-white">Edit Peminjaman</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('borrowings.update', $borrowing->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-4">
                    <label for="customer_name" class="form-label fw-bold">Nama Customer</label>
                    <input type="text" 
                           class="form-control @error('customer_name') is-invalid @enderror"
                           name="customer_name" 
                           id="customer_name"
                           value="{{ old('customer_name', $borrowing->customer_name) }}" 
                           required>
                    @error('customer_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="item_id" class="form-label fw-bold">Barang</label>
                    <select class="form-control @error('item_id') is-invalid @enderror" 
                            name="item_id" 
                            id="item_id" 
                            required>
                        <option value="">Pilih Barang</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}" 
                                {{ old('item_id', $borrowing->item_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('item_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="borrowing_date" class="form-label fw-bold">Tanggal Peminjaman</label>
                    <input type="date" 
                           class="form-control @error('borrowing_date') is-invalid @enderror"
                           name="borrowing_date" 
                           id="borrowing_date"
                           value="{{ old('borrowing_date', $borrowing->borrowing_date) }}" 
                           required>
                    @error('borrowing_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="status" class="form-label fw-bold">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror" 
                            name="status" 
                            id="status" 
                            required>
                        <option value="borrowed" {{ old('status', $borrowing->status) == 'borrowed' ? 'selected' : '' }}>
                            Barang Masih Dipinjam
                        </option>
                        <option value="returned" {{ old('status', $borrowing->status) == 'returned' ? 'selected' : '' }}>
                            Sudah Dikembalikan
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    <a href="{{ route('borrowings.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
