<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Helper\Test;
class AdminController extends Controller
{
    public function index() {
        return view('admin.index');
    }

    public function getListProduct() {
        try {
            $listProduct = Product::with('stocks')->get();

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

}
