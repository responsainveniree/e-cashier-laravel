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
                throw new \InvalidArgumentException("Missing required field. All field must be filled");
            }

            $parsePrice = (int) $request->price;        

            Product::create([
                'name' => $request->name,
                'price' => $request->parsePrice,
                'size' => $request->size,
                'quantity' => $request->quantity,
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

}
