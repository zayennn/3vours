@extends('dashboard.layouts')

@section('title', 'Products')

@section('header title', 'Products')

@section('content')
    <!-- Stats Cards -->
    <section class="stats-section">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-info">
                    <h3 id="totalProducts">0</h3>
                    <p>Total Products</p>
                </div>
                <div class="stat-trend up">
                    <i class="fas fa-arrow-up"></i>
                    <span>12%</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-info">
                    <h3 id="activeProducts">0</h3>
                    <p>Active Products</p>
                </div>
                <div class="stat-trend up">
                    <i class="fas fa-arrow-up"></i>
                    <span>8%</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <div class="stat-info">
                    <h3 id="outOfStock">0</h3>
                    <p>Out of Stock</p>
                </div>
                <div class="stat-trend down">
                    <i class="fas fa-arrow-down"></i>
                    <span>3%</span>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="stat-info">
                    <h3 id="totalCategories">0</h3>
                    <p>Categories</p>
                </div>
                <div class="stat-trend up">
                    <i class="fas fa-arrow-up"></i>
                    <span>5%</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="content-section">
        <!-- Products Table -->
        <div class="table-container">
            <div class="table-header">
                <h3>All Products</h3>
                <div class="table-actions">
                    <div class="filter-group">
                        <select id="categoryFilter" class="filter-select">
                            <option value="">All Categories</option>
                            <option value="electronics">Electronics</option>
                            <option value="clothing">Clothing</option>
                            <option value="books">Books</option>
                            <option value="home">Home & Garden</option>
                        </select>
                        <select id="statusFilter" class="filter-select">
                            <option value="">All Status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="outofstock">Out of Stock</option>
                        </select>
                    </div>
                    <button class="btn btn-primary" id="addProduct">
                        {{-- <i class="fas fa-download"></i> --}}
                        Add Product
                    </button>
                </div>
            </div>

            <div class="table-responsive">
                <table class="products-table">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" id="selectAll">
                            </th>
                            <th>Product</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="productsTableBody">
                        <!-- Products will be populated by JavaScript -->
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <div class="table-info">
                    Showing <span id="showingCount">0</span> of <span id="totalCount">0</span> products
                </div>
                <div class="pagination">
                    <button class="pagination-btn" id="prevPage" disabled>
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <span class="pagination-info">Page <span id="currentPage">1</span> of <span
                            id="totalPages">1</span></span>
                    <button class="pagination-btn" id="nextPage" disabled>
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        const addProduct = document.getElementById('addProduct')

        addProduct.addEventListener('click', function() {
            window.location.href = "{{ route('dashboard.products.create') }}";
        })
    </script>
@endsection
