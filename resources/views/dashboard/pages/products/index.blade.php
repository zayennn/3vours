@extends('dashboard.layouts')

@section('title', 'Products')

@section('content')
    <!-- Header -->
    <header class="header">
        <div class="header-left">
            <button class="menu-toggle" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
            <h1>Product Management</h1>
        </div>

        <div class="header-right">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchProducts" placeholder="Search products...">
            </div>

            <button class="btn btn-primary" id="addProductBtn">
                <i class="fas fa-plus"></i>
                Add Product
            </button>

            <div class="user-menu">
                <div class="notification">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </div>
                <div class="user-profile">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=764ba2&color=fff" alt="User">
                    <span>Admin User</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
            </div>
        </div>
    </header>

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
                    <button class="btn btn-secondary" id="exportBtn">
                        <i class="fas fa-download"></i>
                        Export
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

    <!-- Product Modal -->
    <div id="productModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitle">Add New Product</h3>
                <button class="modal-close" id="modalClose">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="productForm" class="modal-form">
                <div class="form-row">
                    <div class="form-group">
                        <label for="productName">Product Name *</label>
                        <input type="text" id="productName" name="productName" required>
                        <span class="error-message" id="nameError"></span>
                    </div>
                    <div class="form-group">
                        <label for="productSKU">SKU *</label>
                        <input type="text" id="productSKU" name="productSKU" required>
                        <span class="error-message" id="skuError"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="productCategory">Category *</label>
                        <select id="productCategory" name="productCategory" required>
                            <option value="">Select Category</option>
                            <option value="electronics">Electronics</option>
                            <option value="clothing">Clothing</option>
                            <option value="books">Books</option>
                            <option value="home">Home & Garden</option>
                        </select>
                        <span class="error-message" id="categoryError"></span>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Price ($) *</label>
                        <input type="number" id="productPrice" name="productPrice" step="0.01" min="0"
                            required>
                        <span class="error-message" id="priceError"></span>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="productStock">Stock Quantity *</label>
                        <input type="number" id="productStock" name="productStock" min="0" required>
                        <span class="error-message" id="stockError"></span>
                    </div>
                    <div class="form-group">
                        <label for="productStatus">Status</label>
                        <select id="productStatus" name="productStatus">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="outofstock">Out of Stock</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="productDescription">Description</label>
                    <textarea id="productDescription" name="productDescription" rows="4"
                        placeholder="Enter product description..."></textarea>
                </div>

                <div class="form-group">
                    <label for="productImage">Product Image</label>
                    <div class="image-upload">
                        <input type="file" id="productImage" name="productImage" accept="image/*"
                            class="file-input">
                        <div class="upload-area" id="uploadArea">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Click to upload or drag and drop</p>
                            <span>PNG, JPG, GIF up to 5MB</span>
                        </div>
                        <div class="image-preview" id="imagePreview" style="display: none;">
                            <img id="previewImage" src="" alt="Preview">
                            <button type="button" class="remove-image" id="removeImage">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-plus"></i>
                        Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content modal-sm">
            <div class="modal-header">
                <h3>Confirm Delete</h3>
                <button class="modal-close" id="deleteModalClose">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <i class="fas fa-exclamation-triangle warning-icon"></i>
                <p>Are you sure you want to delete this product? This action cannot be undone.</p>
            </div>
            <div class="modal-actions">
                <button class="btn btn-secondary" id="cancelDelete">Cancel</button>
                <button class="btn btn-danger" id="confirmDelete">Delete</button>
            </div>
        </div>
    </div>
@endsection
