<aside class="sidebar">
    <div class="logo">
        <img src="{{ asset('assets/images/logo.png') }}" width="180">
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li class="nav-item {{ Request::is('dashboard/home*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.home') }}">
                    <i class="fas fa-home"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('dashboard/products*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.products') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Produk</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('dashboard/sales*') ? 'active' : '' }}">
                <a href="{{ route('dashboard.sales') }}">
                    <i class="fas fa-chart-bar"></i>
                    <span>Riwayat Pembelian</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>
