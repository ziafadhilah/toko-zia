<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::with('productCategory')->get();
        $categories = Category::with('product')->get();

        $stockPerCategory = [];
        foreach ($categories as $data) {
            $stockPerCategory[$data->name] = $data->product->sum('stock');
        }

        return view('dashboard', [
            'totalProducts' => $products->count(),
            'stockPerCategory' => $stockPerCategory,
        ]);
    }
}
