<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::with('productCategory', 'productThumbnail', 'productPrices')->get();
        return view('product.index', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getProductCategory = Category::all();
        return view('product.create', [
            'getProductCategory' => $getProductCategory,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
            'stock'  => 'required',
        ]);

        DB::beginTransaction();
        try {
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->stock = $request->stock;
            $product->save();

            DB::commit();
            return redirect('/product')->with([
                'success' => 'Product created successfully',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/product')->with([
                'error' => $e,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('product.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $productCategories = Category::all();
        $product = Product::findOrFail($id);
        return view('product.edit', [
            'product' => $product,
            'productCategories' => $productCategories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($id);
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->stock = $request->stock;
            $product->save();

            if ($product->productPrices) {
                $product->productPrices->price = $request->price;
                $product->productPrices->save();
            } else {
                $product->productPrices()->create([
                    'price' => $request->price,
                ]);
            }

            DB::commit();
            return redirect('/product')->with([
                'success' => 'Product updated successfully',
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return redirect('/product')->with([
                'error' => $e,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            Product::destroy($request->id);
            DB::commit();
            session()->flash('success', 'Product deleted successfully.');
            return redirect('product');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
            return redirect('product');
        }
    }
}
