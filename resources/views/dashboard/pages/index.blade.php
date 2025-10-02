@extends('dashboard.layouts')

@section('title', 'Where Food Meets Freshness')

@section('content')
    <!-- Statistik Cards -->
    <section class="stats-cards">
        <div class="card">
            <div class="card-icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="card-info">
                <h3>Total Pesanan</h3>
                <p class="card-value">8,742</p>
                <p class="card-change positive">
                    <i class="fas fa-arrow-up"></i>
                    5.2%
                </p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-info">
                <h3>Pendapatan</h3>
                <p class="card-value">$124,580</p>
                <p class="card-change negative">
                    <i class="fas fa-arrow-down"></i>
                    2.1%
                </p>
            </div>
        </div>
        <div class="card">
            <div class="card-icon">
                <i class="fas fa-chart-line"></i>
            </div>
            <div class="card-info">
                <h3>Pertumbuhan</h3>
                <p class="card-value">18.5%</p>
                <p class="card-change positive">
                    <i class="fas fa-arrow-up"></i>
                    3.4%
                </p>
            </div>
        </div>
    </section>

    <!-- Charts Section -->
    <section class="charts-section">
        <div class="chart-container">
            <div class="chart-header">
                <h2>Statistik Pengunjung</h2>
                <select class="chart-filter">
                    <option>Minggu Ini</option>
                    <option>Bulan Ini</option>
                    <option>Tahun Ini</option>
                </select>
            </div>
            <div class="chart" id="visitorChart">
                <!-- Chart akan di-generate oleh JavaScript -->
            </div>
        </div>
        
        <div class="chart-container">
            <div class="chart-header">
                <h2>Pendapatan</h2>
                <select class="chart-filter">
                    <option>Minggu Ini</option>
                    <option>Bulan Ini</option>
                    <option>Tahun Ini</option>
                </select>
            </div>
            <div class="chart" id="revenueChart">
                <!-- Chart akan di-generate oleh JavaScript -->
            </div>
        </div>
    </section>

    <!-- Recent Activity & Top Products -->
    <section class="tables-section">
        <div class="table-container">
            <div class="table-header">
                <h2>Aktivitas Terbaru</h2>
                <a href="#" class="view-all">Lihat Semua</a>
            </div>
            <table class="activity-table">
                <thead>
                    <tr>
                        <th>Pengguna</th>
                        <th>Aktivitas</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="https://ui-avatars.com/api/?name=John+Doe&background=10b981&color=fff"
                                    alt="John Doe">
                                <span>John Doe</span>
                            </div>
                        </td>
                        <td>Membuat pesanan baru</td>
                        <td>2 menit lalu</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="https://ui-avatars.com/api/?name=Jane+Smith&background=8b5cf6&color=fff"
                                    alt="Jane Smith">
                                <span>Jane Smith</span>
                            </div>
                        </td>
                        <td>Mengupdate profil</td>
                        <td>15 menit lalu</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="https://ui-avatars.com/api/?name=Robert+Johnson&background=f59e0b&color=fff"
                                    alt="Robert Johnson">
                                <span>Robert Johnson</span>
                            </div>
                        </td>
                        <td>Membatalkan pesanan</td>
                        <td>1 jam lalu</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="user-cell">
                                <img src="https://ui-avatars.com/api/?name=Sarah+Williams&background=ef4444&color=fff"
                                    alt="Sarah Williams">
                                <span>Sarah Williams</span>
                            </div>
                        </td>
                        <td>Mengirim pesan</td>
                        <td>2 jam lalu</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="table-container">
            <div class="table-header">
                <h2>Produk Terpopuler</h2>
                <a href="#" class="view-all">Lihat Semua</a>
            </div>
            <table class="products-table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Terjual</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="product-cell">
                                <img src="https://via.placeholder.com/40" alt="Smartphone">
                                <span>Smartphone X1</span>
                            </div>
                        </td>
                        <td>$899</td>
                        <td>1,245</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="product-cell">
                                <img src="https://via.placeholder.com/40" alt="Laptop">
                                <span>Laptop Pro</span>
                            </div>
                        </td>
                        <td>$1,299</td>
                        <td>892</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="product-cell">
                                <img src="https://via.placeholder.com/40" alt="Headphone">
                                <span>Wireless Headphone</span>
                            </div>
                        </td>
                        <td>$199</td>
                        <td>2,134</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="product-cell">
                                <img src="https://via.placeholder.com/40" alt="Smartwatch">
                                <span>Smartwatch S2</span>
                            </div>
                        </td>
                        <td>$349</td>
                        <td>1,567</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
@endsection