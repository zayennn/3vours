<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index() {
        return view('dashboard.pages.products.index');
    }

    public function create() {
        return view('dashboard.pages.products.create');
    }
}
