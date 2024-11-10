<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Thumbnail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ThumbnailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $thumbnail = Thumbnail::all();
        return view('thumbnail.index', [
            'thumbnail' => $thumbnail,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $getProduct = Product::all();
        return view('thumbnail.create', [
            'getProduct' => $getProduct,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'thumbnail_code' => 'required|string|max:255|unique:thumbnails,thumbnail_code',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        DB::beginTransaction();
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('thumbnails', $filename, 'public');


            $thumbnail = new Thumbnail();
            $thumbnail->product_id = $request->product_id;
            $thumbnail->thumbnail_code = $request->thumbnail_code;
            $thumbnail->thumbnail = $filePath;
            $thumbnail->save();
            DB::commit();
            session()->flash('success', 'Thumbnail created successfully.');
        } else {
            DB::rollBack();
            session()->flash('error', 'Failed to upload thumbnail.');
        }

        return redirect('thumbnail');
    }

    /**
     * Display the specified resource.
     */
    public function show(Thumbnail $thumbnail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::all();
        $thumbnail = Thumbnail::findOrFail($id);
        return view('thumbnail.edit', [
            'thumbnail' => $thumbnail,
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $thumbnail = Thumbnail::findOrFail($id);
            $thumbnail->product_id = $request->product_id;
            $thumbnail->thumbnail_code = $request->thumbnail_code;
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $filename = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('thumbnails', $filename, 'public');
                $thumbnail->thumbnail = $filePath;
            }

            $thumbnail->save();
            DB::commit();
            session()->flash('success', 'Thumbnail updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to update thumbnail.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $thumbnail = Thumbnail::findOrFail($id);
            if (Storage::disk('public')->exists($thumbnail->thumbnail)) {
                Storage::disk('public')->delete($thumbnail->thumbnail);
            }
            $thumbnail->delete();

            DB::commit();
            return redirect('thumbnail')->with('success', 'Thumbnail deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect('thumbnail')->with('error', 'Failed to delete thumbnail.');
        }
    }
}
