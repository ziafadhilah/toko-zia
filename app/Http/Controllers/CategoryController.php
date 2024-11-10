<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return view('category.index', [
            'category' => $category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $category = new Category();
            $category->name = $request->name;
            $category->category_code = $request->category_code;
            $category->save();
            DB::commit();
            session()->flash('success', 'Category saved successfully.');
            return redirect('category');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
            return redirect('category');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        // dd($category);
        return view('category.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            $category->category_code = $request->category_code;
            $category->save();
            DB::commit();
            session()->flash('success', 'Category updated successfully.');
            return redirect('category');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
            return redirect('category');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        DB::beginTransaction();
        try {
            Category::destroy($request->id);
            DB::commit();
            session()->flash('success', 'Category deleted successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', $e);
        }

        return redirect('category');
    }
}
