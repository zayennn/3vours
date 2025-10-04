@extends('dashboard.layouts')

@section('title', 'Add Products')

@section('header title', 'Add Products')

@section('content')
    <div class="products-container">
        <!-- Page Header -->
        <div class="page-header">
            <div class="header-content">
                <h1 class="page-title">Add New Product</h1>
                <div class="breadcrumb">
                    <a href="">Dashboard</a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="">Products</a>
                    <i class="fas fa-chevron-right"></i>
                    <span>Add Product</span>
                </div>
            </div>
            <div class="header-actions">
                <a href="{{ route('dashboard.products') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i>
                    Back to Products
                </a>
            </div>
        </div>

        <!-- Product Form -->
        <div class="form-container">
            <form class="product-form" id="productForm">
                <div class="form-grid">
                    <!-- Basic Information -->
                    <div class="form-section">
                        <div class="section-header">
                            <h3><i class="fas fa-info-circle"></i> Basic Information</h3>
                        </div>
                        <div class="form-group">
                            <label for="name" class="form-label">Product Name <span class="required">*</span></label>
                            <input type="text" id="name" name="name" class="form-control"
                                placeholder="Enter product name" required>
                            <div class="error-message" id="nameError"></div>
                        </div>

                        <div class="form-group">
                            <label for="category" class="form-label">Category <span class="required">*</span></label>
                            <select id="category" name="category_id" class="form-control" required>
                                <option value="">Select Category</option>
                                <option value="1">Drink</option>
                                <option value="2">Food</option>
                            </select>
                            <div class="error-message" id="categoryError"></div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea id="description" name="description" class="form-control" rows="4"
                                placeholder="Enter product description"></textarea>
                        </div>
                    </div>

                    <!-- Pricing & Inventory -->
                    <div class="form-section">
                        <div class="section-header">
                            <h3><i class="fas fa-tag"></i> Pricing & Inventory</h3>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="price" class="form-label">Price <span class="required">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" id="price" name="price" class="form-control"
                                        placeholder="0.00" step="0.01" min="0" required>
                                </div>
                                <div class="error-message" id="priceError"></div>
                            </div>

                            <div class="form-group">
                                <label for="stock" class="form-label">Stock Quantity <span
                                        class="required">*</span></label>
                                <input type="number" id="stock" name="stock" class="form-control" placeholder="0"
                                    min="0" required>
                                <div class="error-message" id="stockError"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Images -->
                    <div class="form-section">
                        <div class="section-header">
                            <h3><i class="fas fa-images"></i> Product Images</h3>
                        </div>

                        <div class="form-group">
                            <label class="form-label">Main Image</label>
                            <div class="image-upload-container">
                                <input type="file" id="main_image" name="main_image" class="file-input" accept="image/*">
                                <div class="upload-area" id="mainUploadArea">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Click to upload main image</p>
                                    <span>PNG, JPG, JPEG up to 5MB</span>
                                </div>
                                <div class="image-preview" id="mainImagePreview">
                                    <img id="mainPreview" src="" alt="Main image preview">
                                    <button type="button" class="remove-image" onclick="removeMainImage()">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="form-group">
                            <label class="form-label">Additional Images</label>
                            <div class="image-upload-container">
                                <input type="file" id="gallery_images" name="gallery_images[]" class="file-input"
                                    accept="image/*" multiple>
                                <div class="upload-area" id="galleryUploadArea">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Click to upload gallery images</p>
                                    <span>PNG, JPG, JPEG up to 5MB each</span>
                                </div>
                                <div class="gallery-preview" id="galleryPreview"></div>
                            </div>
                        </div> --}}
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Add Product
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
