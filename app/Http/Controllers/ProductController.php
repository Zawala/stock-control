<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        $product = Product::create($request->all());
        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ], 200);
    } catch (\Exception $e) {
        // Log the error message for debugging purposes
        \Log::error($e->getMessage());

        // Return a custom error response
        return response()->json([
            'success' => false,
            'message' => 'There was a problem creating the product.',
            'error' => $e->getMessage() // Optionally include the error message for debugging
        ], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show(Product $product) : View
    {
        return view('products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product) : View
    {
        return view('products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
{
    $product->update($request->all());
    return response()->json($product, 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
{
    if (!$product) {
        return response()->json([
            'success' => false,
            'message' => 'Product not found',
        ], 404);
    }

    $product->delete();
    return response()->json([
        'success' => true,
        'message' => 'Product deleted successfully',
    ], 200);
}
}
