@extends('dashboard.layouts')

@section('title', 'Edit Product')
@section('header title', 'Edit Product')

@section('content')
    <section class="form-section">
        <form action="{{ route('dashboard.products.update', $product->id) }}" method="POST" enctype="multipart/form-data"
            class="product-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select id="category_id" name="category_id" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" required>
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="main_image">Main Image</label>
                <input type="file" id="main_image" name="main_image" accept="image/*">
                <div class="preview">
                    <img src="{{ asset('storage/' . $product->main_image) }}" alt="Product Image" width="100">
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update Product</button>
        </form>
    </section>
@endsection