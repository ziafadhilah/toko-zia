<?php

namespace App\Http\Controllers;

use App\Models\Price;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prices = Price::with('product')->get();
        return view('price.index', [
            'price' => $prices,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getProduct = Product::whereDoesntHave('productPrices')->get();
        return view('price.create', [
            'getProduct' => $getProduct,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $prices = new Price();
            $prices->product_id = $request->product_id;
            $prices->price = $request->price;
            $prices->save();
            DB::commit();
            session()->flash('success', 'Price saved successfully.');
            return redirect('price');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
            return redirect('price');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $price = Price::findOrFail($id);
        $getProduct = Product::all();
        // dd($category);
        return view('price.edit', [
            'price' => $price,
            'getProduct' => $getProduct,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            $prices = Price::findOrFail($id);
            $prices->product_id = $request->product_id;
            $prices->price = $request->price;
            $prices->save();
            DB::commit();
            session()->flash('success', 'Price updated successfully.');
            return redirect('price');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
            return redirect('price');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            Price::destroy($request->id);
            DB::commit();
            session()->flash('success', 'Price deleted successfully.');
            return redirect('price');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
            return redirect('price');
        }
    }
}
