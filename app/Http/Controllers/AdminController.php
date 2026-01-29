<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Helper\Test;
class AdminController extends Controller
{

    private $dataPerPage = 10;

    public function index() {
        return view('admin.index');
    }

    public function getListProduct(Request $request) {
        try {
            $perPage = $request->get('per_page', $this->dataPerPage);

            $listProduct = Product::with('stocks')
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);

            return response()->json([
                'message' => 'Get data list product successfully',
                'data' => $listProduct
            ], 200);
        } catch(\Exception $error) {
            return response()->json([
                'message' => $error->getMessage(),
            ], 500);
        }
    }

    public function sendProductData(Request $request) {
        try {
            if(!$request->name || !$request->price || !$request->size || !$request->quantity || !$request->description) {
                return response()->json([
                    'message' => "Missing required field. All field must be filled"
                ], 422); // ← 422 Unprocessable Entity untuk validation error
            }
                $parsePrice = (int) $request->price;
                $parseQuantity = (int) $request->quantity;

                Product::create([
                    'name' => $request->name,
                    'price' => $parsePrice,
                    'size' => $request->size,
                    'quantity' => $parseQuantity,
                    'description' => $request->description,
                    ]);

                return response()->json([
                    'message' => "Successfully create product data"
                ], 200);
            } catch (\Exception $error) {
                return response()->json([
                    'message' => $error->getMessage(),
                ], 500);
        }
    }

    public function editProductData(Request $request) {
    try {
        // Validasi semua field termasuk ID
        if(!$request->id || !$request->name || !$request->price || !$request->size || !$request->quantity || !$request->description) {
            return response()->json([
                'message' => "Missing required field. All fields must be filled"
            ], 422);
        }

        $parsePrice = (int) $request->price;
        $parseQuantity = (int) $request->quantity;

        // Cari product berdasarkan ID
        $product = Product::find($request->id);

        if (!$product) {
            return response()->json([
                'message' => "Product not found"
            ], 404);
        }

        // Update product
        $product->update([
            'name' => $request->name,
            'price' => $parsePrice,
            'size' => $request->size,
            'quantity' => $parseQuantity,
            'description' => $request->description,
        ]);

        return response()->json([
            'message' => "Successfully update product data",
            'data' => $product
        ], 200);

    } catch (\Exception $error) {
        return response()->json([
            'message' => $error->getMessage(),
        ], 500);
    }
}

}
