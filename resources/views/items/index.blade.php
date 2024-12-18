@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-lg rounded-lg mb-4">
        <div class="card-header bg-gradient-primary text-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0 text-white">Daftar Barang</h1>
                <a href="{{ route('items.create') }}" class="btn btn-light">
                    <i class="fas fa-plus-circle"></i> Tambah Barang
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr class="bg-light">
                            <th class="rounded-start">#</th>
                            <th>Gambar</th>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Deskripsi</th>
                            <th>Stok</th>
                            <th class="rounded-end text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($items as $item)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($item->image)
                                        <img src="{{ asset('storage/'.$item->image) }}" 
                                             alt="{{ $item->name }}" 
                                             class="rounded-3 shadow-sm img-preview" width="100" height="100">
                                    @else
                                        <div class="no-image-placeholder">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                    <!-- <img src="images/{{ Session::get('image') }}"> -->
                                </td>
                                <td class="fw-bold">{{ $item->name }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-primary text-white">
                                        
                                        {{ $item->category->category_name ?? 'Tiak ada Data' }}
                                    </span>
                                </td>
                                <td>{{ Str::limit($item->description, 50) }}</td>
                                <td>
                                    <span class="badge rounded-pill text-white {{ $item->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $item->stock }} unit
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2 ">
                                        <a href="{{ route('items.edit', $item->id) }}" 
                                           class="btn btn-warning btn-sm rounded-pill">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('items.destroy', $item->id) }}" 
                                              method="POST" 
                                              class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm rounded-pill">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                                        <p class="h5 text-muted">Belum ada data barang</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .bg-gradient-primary {
        background: linear-gradient(45deg, #4e73df, #224abe);
    }
    /* .img-preview {
        width: 48px;
        height: 48px;
        object-fit: cover;
        transition: transform 0.2s;
    } */
    .img-preview {
    width: 32px;
    height: 32px;
    object-fit: cover;
    transition: transform 0.2s;
}

    .img-preview:hover {
        transform: scale(1.1);
    }
    
    /* .no-image-placeholder {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border-radius: 0.5rem;
    } */
    .no-image-placeholder {
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #f8f9fa;
    border-radius: 0.5rem;
}

    .no-image-placeholder i {
        font-size: 2rem;
    }        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f8f9fa;
        border-radius: 0.5rem;
    }
    
    .empty-state {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2rem;
    }
    
    .delete-form {
        margin: 0;
        padding: 0;
        display: inline;
    }
    
    .table th {
        font-weight: 600;
    }

    td {
        vertical-align: middle;
    }

    .d-flex {
        display: flex;
    }

    .justify-content-center {
        justify-content: center;
    }

    .gap-2 {
        gap: 0.5rem;
    }

    .btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        vertical-align: middle;
        user-select: none;
        border: 1px solid transparent;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: 0.25rem;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }

    .btn-warning {
        color: #212529;
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .btn-danger {
        color: #fff;
        background-color: #dc3545;
        border-color: #dc3545;
    }

    .rounded-pill {
        border-radius: 50rem !important;
    }

    .d-none {
        display: none !important;
    }        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.5em 1em;
    }

    /* Add to existing styles */
    .text-gray-800 {
        color: #2d3748;
    }
    
    .text-gray-700 {
        color: #4a5568;
    }
    
    .text-gray-600 {
        color: #718096;
    }
    
    .table td {
        color: #4a5568;
    }
</style>
@endpush
@push('scripts')
<script>
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (confirm('Yakin ingin menghapus barang ini?')) {
            this.submit();
        }
    });
});

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
});
</script>
@endpush
@endsection

