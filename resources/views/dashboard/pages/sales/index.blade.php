@extends('dashboard.layouts')

@section('title', 'Riwayat Pembelian')

@section('header title', 'Riwayat Pembelian')

@section('content')
    <div class="purchase-history-container">
        <!-- Stats Cards -->
        <div class="stats-section">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-info">
                        <h3>0</h3>
                        <p>Total Pembelian</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <h3>0</h3>
                        <p>Selesai</p>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="stat-info">
                        <h3>Rp 0</h3>
                        <p>Total Pengeluaran</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Purchase History Table -->
        <div class="table-container">
            <div class="table-header">
                <h3>Daftar Pembelian</h3>
                <div class="table-info">
                    Menampilkan 0 dari 0 pembelian
                </div>
            </div>

            <div class="table-responsive">
                <table class="purchase-table">
                    <thead>
                        <tr>
                            <th>No. PO</th>
                            <th>Supplier</th>
                            <th>Tanggal</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#PO0001</td>
                            <td>Supplier Contoh</td>
                            <td>07 Okt 2025</td>
                            <td>3 Items</td>
                            <td>Rp 1.000.000</td>
                            <td><span class="status-badge status-completed">Selesai</span></td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>#PO0002</td>
                            <td>Supplier Demo</td>
                            <td>06 Okt 2025</td>
                            <td>5 Items</td>
                            <td>Rp 2.500.000</td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-footer">
                <div class="pagination-info">
                    Menampilkan halaman 1 dari 1
                </div>
                <div class="pagination">
                    <span class="page-item active">1</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        class ProductsCardManager {
            constructor() {
                this.init();
            }

            init() {
                this.setupEventListeners();
                this.setupQuantityControls();
                this.setupFilters();
            }

            setupEventListeners() {
                // Add product button
                const addProductBtn = document.getElementById('addProduct');
                const addFirstProductBtn = document.getElementById('addFirstProduct');

                if (addProductBtn) {
                    addProductBtn.addEventListener('click', () => this.addProduct());
                }

                if (addFirstProductBtn) {
                    addFirstProductBtn.addEventListener('click', () => this.addProduct());
                }

                // Quick view buttons
                const viewButtons = document.querySelectorAll('.btn-view');
                viewButtons.forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const productCard = e.target.closest('.product-card');
                        this.showQuickView(productCard);
                    });
                });

                // Modal close
                const quickViewClose = document.getElementById('quickViewClose');
                if (quickViewClose) {
                    quickViewClose.addEventListener('click', () => this.closeQuickView());
                }

                // Close modal when clicking outside
                document.addEventListener('click', (e) => {
                    if (e.target.classList.contains('modal')) {
                        this.closeQuickView();
                    }
                });
            }

            setupQuantityControls() {
                // Plus buttons
                const plusButtons = document.querySelectorAll('.plus-btn');
                plusButtons.forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const input = e.target.closest('.quantity-controls').querySelector(
                            '.quantity-input');
                        const max = parseInt(input.getAttribute('max'));
                        let value = parseInt(input.value) || 0;

                        if (value < max) {
                            input.value = value + 1;
                            this.updateButtonStates(input);
                        }
                    });
                });

                // Minus buttons
                const minusButtons = document.querySelectorAll('.minus-btn');
                minusButtons.forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        const input = e.target.closest('.quantity-controls').querySelector(
                            '.quantity-input');
                        let value = parseInt(input.value) || 0;

                        if (value > 0) {
                            input.value = value - 1;
                            this.updateButtonStates(input);
                        }
                    });
                });

                // Input changes
                const quantityInputs = document.querySelectorAll('.quantity-input');
                quantityInputs.forEach(input => {
                    input.addEventListener('change', (e) => {
                        const value = parseInt(e.target.value) || 0;
                        const max = parseInt(e.target.getAttribute('max'));
                        const min = parseInt(e.target.getAttribute('min'));

                        if (value > max) {
                            e.target.value = max;
                        } else if (value < min) {
                            e.target.value = min;
                        }

                        this.updateButtonStates(e.target);
                    });

                    input.addEventListener('input', (e) => {
                        // Allow only numbers
                        e.target.value = e.target.value.replace(/[^0-9]/g, '');
                    });
                });
            }

            updateButtonStates(input) {
                const value = parseInt(input.value) || 0;
                const max = parseInt(input.getAttribute('max'));
                const controls = input.closest('.quantity-controls');
                const minusBtn = controls.querySelector('.minus-btn');
                const plusBtn = controls.querySelector('.plus-btn');

                minusBtn.disabled = value <= 0;
                plusBtn.disabled = value >= max;

                // Visual feedback
                if (value > 0) {
                    input.style.borderColor = 'var(--primary-color)';
                    input.style.background = '#f0f9ff';
                } else {
                    input.style.borderColor = '#e2e8f0';
                    input.style.background = 'white';
                }
            }

            setupFilters() {
                const categoryFilter = document.getElementById('categoryFilter');
                const statusFilter = document.getElementById('statusFilter');

                if (categoryFilter) {
                    categoryFilter.addEventListener('change', () => this.applyFilters());
                }

                if (statusFilter) {
                    statusFilter.addEventListener('change', () => this.applyFilters());
                }
            }

            applyFilters() {
                const categoryValue = document.getElementById('categoryFilter').value;
                const statusValue = document.getElementById('statusFilter').value;
                const productCards = document.querySelectorAll('.product-card');
                let visibleCount = 0;

                productCards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    const status = card.getAttribute('data-status');

                    const categoryMatch = !categoryValue || category === categoryValue;
                    const statusMatch = !statusValue || status === statusValue;

                    if (categoryMatch && statusMatch) {
                        card.style.display = 'block';
                        visibleCount++;

                        // Add animation
                        card.style.animation = 'fadeInUp 0.5s ease';
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Update showing count
                const showingCount = document.getElementById('showingCount');
                if (showingCount) {
                    showingCount.textContent = visibleCount;
                }

                // Show empty state if no products
                this.toggleEmptyState(visibleCount === 0);
            }

            toggleEmptyState(show) {
                let emptyState = document.querySelector('.empty-state');

                if (show && !emptyState) {
                    emptyState = this.createEmptyState();
                    document.getElementById('productsGrid').appendChild(emptyState);
                } else if (!show && emptyState) {
                    emptyState.remove();
                }
            }

            createEmptyState() {
                const emptyState = document.createElement('div');
                emptyState.className = 'empty-state';
                emptyState.innerHTML = `
            <i class="fas fa-box-open"></i>
            <h4>No Products Found</h4>
            <p>Try adjusting your filters to find what you're looking for.</p>
        `;
                return emptyState;
            }

            showQuickView(productCard) {
                const productName = productCard.querySelector('.product-title').textContent;
                const productDescription = productCard.querySelector('.product-description').textContent;
                const productPrice = productCard.querySelector('.price').textContent;
                const productStock = productCard.querySelector('.stock').textContent;
                const productImage = productCard.querySelector('.product-image img').src;
                const productCategory = productCard.querySelector('.category-badge').textContent;

                const modalContent = `
            <div class="quick-view-content">
                <div class="quick-view-image">
                    <img src="${productImage}" alt="${productName}">
                </div>
                <div class="quick-view-info">
                    <div class="quick-view-category">${productCategory}</div>
                    <h3>${productName}</h3>
                    <p class="quick-view-description">${productDescription}</p>
                    <div class="quick-view-price">${productPrice}</div>
                    <div class="quick-view-stock">${productStock}</div>
                </div>
            </div>
        `;

                document.getElementById('quickViewContent').innerHTML = modalContent;
                document.getElementById('quickViewModal').classList.add('active');
            }

            closeQuickView() {
                document.getElementById('quickViewModal').classList.remove('active');
            }

            addProduct() {
                // Redirect to add product page or show modal
                console.log('Add product clicked');
                // window.location.href = '/dashboard/products/create';
            }
        }

        // Confirmation for delete
        function confirmDelete() {
            return confirm('Yakin mau hapus produk ini? 😢');
        }

        // Add CSS animations
        const productStyles = `
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .product-card {
        animation: fadeInUp 0.6s ease;
    }

    .quick-view-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        align-items: start;
    }

    .quick-view-image img {
        width: 100%;
        border-radius: 12px;
    }

    .quick-view-category {
        padding: 4px 12px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: white;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-block;
        margin-bottom: 10px;
    }

    .quick-view-info h3 {
        margin: 0 0 10px 0;
        font-size: 1.4rem;
        color: var(--text-primary);
    }

    .quick-view-description {
        color: var(--text-secondary);
        line-height: 1.6;
        margin-bottom: 15px;
    }

    .quick-view-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 8px;
    }

    .quick-view-stock {
        font-size: 0.9rem;
        color: var(--text-secondary);
        font-weight: 500;
    }

    @media (max-width: 768px) {
        .quick-view-content {
            grid-template-columns: 1fr;
        }
        
        .quick-view-image {
            text-align: center;
        }
        
        .quick-view-image img {
            max-width: 300px;
        }
    }
`;

        // Inject styles
        const styleSheet = document.createElement('style');
        styleSheet.textContent = productStyles;
        document.head.appendChild(styleSheet);

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            new ProductsCardManager();
        });
    </script>
@endsection
