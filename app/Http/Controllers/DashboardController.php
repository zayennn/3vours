<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function home() {
        return view('dashboard.pages.index');
    }

    public function products() {
        return view('dashboard.pages.products');
    }
    
    public function sales() {
        return view('dashboard.pages.sales');
    }
}
