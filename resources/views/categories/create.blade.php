@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-lg rounded-lg mb-4">
        <div class="card-header bg-gradient-primary text-white py-3">
            <h1 class="h3 mb-0 text-white">{{ isset($category) ? 'Edit Kategori' : 'Tambah Kategori Baru' }}</h1>
        </div>

        <div class="card-body">
            <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif

                <div class="form-group mb-4">
                    <label for="category_name" class="form-label fw-bold">Nama Kategori</label>
                    <input type="text" 
                           class="form-control @error('category_name') is-invalid @enderror" 
                           name="category_name" 
                           id="category_name" 
                           value="{{ old('category_name', $category->category_name ?? '') }}" 
                           required>
                    @error('category_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>
                        {{ isset($category) ? 'Update Kategori' : 'Simpan Kategori' }}
                    </button>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary">
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