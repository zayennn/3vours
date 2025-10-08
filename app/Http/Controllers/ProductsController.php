<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();

        return view('dashboard.pages.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('dashboard.pages.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'main_image' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'description' => 'required|string',
        ]);

        $imagePath = null;
        if ($request->hasFile('main_image')) {
            $imagePath = $request->file('main_image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'main_image' => $imagePath,
            'status' => $request->stock > 0 ? 'active' : 'outofstock',
        ]);

        return redirect()->route('dashboard.products')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('dashboard.pages.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'main_image' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'description' => 'required|string',
        ]);

        $imagePath = $product->main_image;

        if ($request->hasFile('main_image')) {
            if ($product->main_image && Storage::disk('public')->exists($product->main_image)) {
                Storage::disk('public')->delete($product->main_image);
            }

            $imagePath = $request->file('main_image')->store('products', 'public');
        }

        $product->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'main_image' => $imagePath,
            'status' => $request->stock > 0 ? 'active' : 'outofstock',
        ]);

        return redirect()->route('dashboard.products')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->main_image && Storage::disk('public')->exists($product->main_image)) {
            Storage::disk('public')->delete($product->main_image);
        }

        $product->delete();

        return redirect()->route('dashboard.products')->with('success', 'Product deleted successfully!');
    }
}
