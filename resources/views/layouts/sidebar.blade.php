<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Penyewaan Barang</div>
    </a>

    <hr class="sidebar-divider my-0">

    <li class="nav-item active">
        <a class="nav-link" href="{{ url('/dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Menu Pengguna -->

    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
    </li>

    <!-- Menu Kategori -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('categories.index') }}">
            <i class="fas fa-fw fa-list"></i>
            <span>Kategori Barang</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('items.index') }}">
            <i class="fas fa-boxes"></i>
            <span>Barang</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('borrowings.index') }}">
            <i class="fas fa-handshake"></i>
            <span>Penyewaan</span>
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('returnings.index') }}">
            <i class="fas fa-handshake"></i>
            <span>Pengembalian</span>
        </a>
    </li>

</ul>
