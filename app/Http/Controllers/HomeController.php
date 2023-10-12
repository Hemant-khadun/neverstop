<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('metadata')->where('status', '=', 'ACTIVE')->get();
        return view('home', ['products' => $products]);
    }

}
