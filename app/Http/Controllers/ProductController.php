<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function productPage(){
        return view('pages.product-page');
    }

    public function showProduct(){
        $productData = Product::get();
        return response()->json($productData);
    }




    public function createProduct(Request $request){
        $request->validate([
            'p_name' => 'required|string|max:255',
            'p_price' => 'required|string|min:0',
        ]);
        try {
            Product::create([
                'user_id'=>auth()->user()->id,
                'p_name'=> $request-> input('p_name'),
                'p_price'=> $request-> input('p_price'),
            ]);
            return response()->json([
                'status' => 'Success',
                'message' => 'Product Created Successfully',
            ], 201);
        } catch(Exception $e){
            return response()->json([
                'status' => 'Failed',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    




//This function is use to delete data from database
public function deleteProduct(Request $request) {
    try {
        $product_id = $request->input('id');
        $deleted = Product::where('id', $product_id)->delete();

        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => 'Product deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Product deletion failed'
            ]);
        }
    } catch (Exception $e) {
        return response()->json([
            'status' => 'failed',
            'message' => 'Something went wrong: ' . $e->getMessage()
        ]);
    }
}


//Product Update
// This function is use to get product for update

public function getProduct(Request $request)
{
    try {
        $product = Product::find($request->input('id'));
        if ($product) {
            return response()->json($product, 200);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    } catch (Exception $e) {
        return response()->json(['message' => $e->getMessage()], 500);
    }
}


//Update function

public function updateProduct(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:products,id',
        'p_name' => 'required|string|max:255',
        'p_price' => 'required|string|max:15',
    ]);

    $product = Product::find($request->input('id'));

    if ($product) {
        $product->p_name = $request->input('p_name');
        $product->p_price = $request->input('p_price');

       
        $product->save();
        return response()->json([
            'status' => 'Success',
            'message' => 'Product updated successfully',
        ]);
    } else {
        return response()->json([
            'status' => 'Fail',
            'message' => 'Product not found',
        ], 404);
    }
}

//for order 

public function getAllProducts()
    {
        $products = Product::all();
        return response()->json($products);
    }

}
