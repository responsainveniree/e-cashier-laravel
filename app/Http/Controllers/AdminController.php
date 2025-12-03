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

}
