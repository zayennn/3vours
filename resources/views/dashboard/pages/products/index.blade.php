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
        <!-- Products Header -->
        <div class="products-header">
            <h3>All Products</h3>
            <div class="products-actions">
                <div class="filter-group">
                    <select id="categoryFilter" class="filter-select">
                        <option value="">All Categories</option>
                        <option value="drinks">Drinks</option>
                        <option value="foods">Foods</option>
                    </select>
                    <select id="statusFilter" class="filter-select">
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="outofstock">Out of Stock</option>
                    </select>
                </div>
                @if (Auth::user() && Auth::user()->hasRole('admin'))
                    <button class="btn btn-primary" id="addProduct">
                        <i class="fas fa-plus"></i>
                        Add Product
                    </button>
                @endif
            </div>
        </div>

        <!-- Products Grid -->
        <div class="products-grid" id="productsGrid">
            @forelse ($products as $product)
                <div class="product-card" data-category="{{ strtolower($product->category->name) }}"
                    data-status="{{ $product->status }}">
                    <!-- Product Image -->
                    <div class="product-image">
                        <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}"
                            onerror="this.src='https://via.placeholder.com/300x200?text=No+Image'">
                        <div class="product-badges">
                            @if ($product->stock == 0)
                                <span class="badge badge-outofstock">Out of Stock</span>
                            @elseif($product->stock < 10)
                                <span class="badge badge-lowstock">Low Stock</span>
                            @endif
                            @if ($product->status == 'inactive')
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </div>
                        <div class="product-overlay">
                            <button class="btn-view" title="Quick View">
                                <i class="fas fa-eye"></i>
                            </button>
                            @if (Auth::user() && Auth::user()->hasRole('admin'))
                                <button class="btn-edit" title="Edit Product"
                                    onclick="window.location.href='{{ route('dashboard.products.edit', $product->id) }}'">
                                    <i class="fas fa-edit"></i>
                                </button>
                            @endif
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="product-info">
                        <div class="product-category">
                            <span class="category-badge">{{ $product->category->name }}</span>
                        </div>
                        <h4 class="product-title">{{ $product->name }}</h4>
                        <p class="product-description">
                            {{ Str::limit($product->description ?? 'No description available', 80) }}</p>

                        <div class="product-price">
                            <span class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            <span class="stock">Stock: {{ $product->stock }}</span>
                        </div>

                        <!-- Quantity Controls -->
                        <div class="quantity-controls">
                            <button class="quantity-btn minus-btn" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                <i class="fas fa-minus"></i>
                            </button>
                            <input type="number" class="quantity-input" value="0" min="0"
                                max="{{ $product->stock }}" {{ $product->stock == 0 ? 'disabled' : '' }}>
                            <button class="quantity-btn plus-btn" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>

                        <!-- Action Buttons -->
                        <div class="product-actions">
                            @if (Auth::user() && Auth::user()->hasRole('admin'))
                                <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn-action btn-edit">
                                    <i class="fas fa-edit"></i>
                                    Edit
                                </a>
                                <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST"
                                    class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" onclick="return confirmDelete()">
                                        <i class="fas fa-trash"></i>
                                        Delete
                                    </button>
                                </form>
                            @else
                                <button class="btn-action btn-add-to-cart" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-shopping-cart"></i>
                                    Add to Cart
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <h4>No Products Found</h4>
                    <p>There are no products available at the moment.</p>
                    @if (Auth::user() && Auth::user()->hasRole('admin'))
                        <button class="btn btn-primary" id="addFirstProduct">
                            <i class="fas fa-plus"></i>
                            Add Your First Product
                        </button>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Pagination -->

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
