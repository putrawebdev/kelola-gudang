<aside class="sidebar glass">
    <div class="brand">
        <span class="brand-logo"><i class="bi bi-box-seam"></i></span>
        <span class="brand-name">kelola gudang</span>
    </div>

    <div class="side-search">
        <input type="text" aria-label="Cari menu" id="menuSearch">
        <i class="bi bi-search"></i>
    </div>

    <nav class="menu">
        <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door"></i> Dashboard
        </a>
        <a href="{{ route('kategori.index') }}" class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Data Kategori
        </a>
        <a href="{{ route('barang.index') }}" class="{{ request()->routeIs('barang.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Data Barang
        </a>
    </nav>

    <form action="{{ route('logout') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit" class="logout"><i class="bi bi-box-arrow-right"></i> Logout</button>
    </form>
</aside>
