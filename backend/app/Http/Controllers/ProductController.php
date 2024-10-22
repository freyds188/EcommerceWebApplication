<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Retrieve all products
    public function index()
    {
        $products = Product::all();
        return response()->json([
            'success' => true,
            'data' => $products
        ], 200); // Return all products with 200 OK status
    }

    // Create a new product
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', // Ensure the name field is required
            'barcode' => 'required|string|unique:products,barcode|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|string|max:255',
        ]);

        $product = Product::create($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ], 201); // Return created product with 201 Created status
    }

    // Retrieve a single product
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404); // Return 404 if product not found
        }

        return response()->json([
            'success' => true,
            'data' => $product
        ], 200); // Return the product with 200 OK status
    }

    // Update an existing product
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404); // Return 404 if product not found
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255', // Name can be updated
            'barcode' => 'sometimes|required|string|unique:products,barcode,' . $product->id . '|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|string|max:255',
        ]);

        $product->update($validatedData);

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $product
        ], 200); // Return updated product with 200 OK status
    }

    // Delete a product
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ], 404); // Return 404 if product not found
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully'
        ], 200); // Return success message with 200 OK status
    }
}
