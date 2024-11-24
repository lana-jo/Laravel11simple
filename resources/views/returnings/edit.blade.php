
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-lg rounded-lg mb-4">
        <div class="card-header bg-gradient-primary text-white py-3">
            <h1 class="h3 mb-0 text-white">Edit Data Pengembalian</h1>
        </div>

        <div class="card-body">
            <form action="{{ route('returnings.update', $returning->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-4">
                    <label class="form-label fw-bold">Item yang Dikembalikan</label>
                    <input type="text" class="form-control" value="{{ $returning->rental->item->name }}" readonly>
                </div>

                <div class="form-group mb-4">
                    <label for="return_date" class="form-label fw-bold">Tanggal Pengembalian</label>
                    <input type="date" class="form-control @error('return_date') is-invalid @enderror" 
                           name="return_date" id="return_date" value="{{ old('return_date', $returning->return_date) }}" required>
                    @error('return_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="condition" class="form-label fw-bold">Kondisi</label>
                    <select class="form-control @error('condition') is-invalid @enderror" name="condition" id="condition" required>
                        <option value="Baik" {{ $returning->condition == 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak" {{ $returning->condition == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                        <option value="Hilang" {{ $returning->condition == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                    </select>
                    @error('condition')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="fine_amount" class="form-label fw-bold">Denda</label>
                    <input type="number" class="form-control @error('fine_amount') is-invalid @enderror" 
                           name="fine_amount" id="fine_amount" value="{{ old('fine_amount', $returning->fine_amount) }}" required>
                    @error('fine_amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-4">
                    <label for="notes" class="form-label fw-bold">Catatan</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" 
                              name="notes" id="notes" rows="3">{{ old('notes', $returning->notes) }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>
                        Update Pengembalian
                    </button>
                    <a href="{{ route('returnings.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i>
                        Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #4e73df, #224abe);
    }
    
    .form-label {
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>
@endpush
@endsection
