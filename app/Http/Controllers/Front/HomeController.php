<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $products = Product::active()->latest()->get();
        $slider_products = Product::active()->latest()->take(3)->get();
        return view('front.home1', compact('products', 'slider_products'));
    }
}
