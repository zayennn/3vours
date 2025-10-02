@extends('dashboard.layouts')

@section('title', 'Products')

@section('content')
    <div class="products-header">
        <div class="products-stats">
            <div class="stat-item">
                <h3 id="totalProducts">0</h3>
                <p>Total Products</p>
            </div>
            <div class="stat-item">
                <h3 id="activeProducts">0</h3>
                <p>Active Products</p>
            </div>
            <div class="stat-item">
                <h3 id="outOfStock">0</h3>
                <p>Out of Stock</p>
            </div>
        </div>

        <button class="btn btn-primary" id="addProductBtn">
            <i class="fas fa-plus"></i>
            Add New Product
        </button>
    </div>

    <!-- Filters and Actions -->
    <div class="products-filters">
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
            </select>

            <select id="stockFilter" class="filter-select">
                <option value="">All Stock</option>
                <option value="in-stock">In Stock</option>
                <option value="out-of-stock">Out of Stock</option>
            </select>
        </div>

        <div class="actions-group">
            <button class="btn btn-secondary" id="exportBtn">
                <i class="fas fa-download"></i>
                Export
            </button>
            <button class="btn btn-secondary" id="refreshBtn">
                <i class="fas fa-sync-alt"></i>
                Refresh
            </button>
        </div>
    </div>

    <!-- Products Table -->
    <div class="products-table-container">
        <table class="products-table" id="productsTable">
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
                <!-- Products will be loaded here dynamically -->
            </tbody>
        </table>

        <!-- Loading State -->
        <div class="loading-state" id="loadingState">
            <i class="fas fa-spinner fa-spin"></i>
            <p>Loading products...</p>
        </div>

        <!-- Empty State -->
        <div class="empty-state" id="emptyState" style="display: none;">
            <i class="fas fa-box-open"></i>
            <h3>No products found</h3>
            <p>There are no products matching your criteria.</p>
            <button class="btn btn-primary" id="addFirstProductBtn">
                <i class="fas fa-plus"></i>
                Add Your First Product
            </button>
        </div>
    </div>

    <!-- Pagination -->
    <div class="pagination" id="pagination">
        <button class="pagination-btn" id="prevPage" disabled>
            <i class="fas fa-chevron-left"></i>
            Previous
        </button>

        <div class="pagination-info">
            Page <span id="currentPage">1</span> of <span id="totalPages">1</span>
        </div>

        <button class="pagination-btn" id="nextPage" disabled>
            Next
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>

    <!-- Add/Edit Product Modal -->
    <div class="modal" id="productModal">
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
                        <label for="productSku">SKU *</label>
                        <input type="text" id="productSku" name="productSku" required>
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
                        <div class="upload-placeholder" id="imagePreview">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <p>Click to upload product image</p>
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveBtn">
                        <i class="fas fa-save"></i>
                        Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteModal">
        <div class="modal-content modal-sm">
            <div class="modal-header">
                <h3>Confirm Delete</h3>
                <button class="modal-close" id="deleteModalClose">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <div class="modal-body">
                <i class="fas fa-exclamation-triangle warning-icon"></i>
                <p>Are you sure you want to delete <strong id="deleteProductName">this product</strong>?</p>
                <p class="warning-text">This action cannot be undone.</p>
            </div>

            <div class="modal-actions">
                <button class="btn btn-secondary" id="cancelDeleteBtn">Cancel</button>
                <button class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="fas fa-trash"></i>
                    Delete Product
                </button>
            </div>
        </div>
    </div>
@endsection
