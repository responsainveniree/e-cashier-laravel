<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class AdminController extends Controller
{
    private $dataPerPage = 10;

    public function index()
    {
        return view("admin.index");
    }

    public function getListProduct(Request $request)
    {
        try {
            $perPage = $request->get("per_page", $this->dataPerPage);

            $listProduct = Product::with("stocks")
                ->withSum("stocks", "quantity")
                ->orderBy("created_at", "desc")
                ->paginate($perPage);

            // $totalQuantity = $listProduct . stocks;

            return response()->json(
                [
                    "message" => "Get data list product successfully",
                    "data" => $listProduct,
                ],
                200,
            );
        } catch (\Exception $error) {
            return response()->json(
                [
                    "message" => $error->getMessage(),
                ],
                500,
            );
        }
    }

    public function storeProduct(StoreProductRequest $request)
    {
        try {
            $data = $request->validated();

            $product = Product::create([
                "name" => $data["name"],
                "price" => $data["price"],
                "description" => $data["description"],
                "size" => $data["size"],
            ]);

            $product->stocks()->create([
                "quantity" => $data["quantity"],
            ]);

            return response()->json(
                [
                    "message" => "Successfully create product data",
                    "data" => $product,
                ],
                201,
            );
        } catch (\Exception $error) {
            return response()->json(
                [
                    "message" => $error->getMessage(),
                ],
                500,
            );
        }
    }

    public function editProductData(UpdateProductRequest $request)
    {
        try {
            $product = Product::findOrFail($request->id);

            if (!$product) {
                return response()->json(
                    [
                        "message" => "Product not found",
                    ],
                    404,
                );
            }

            $product->update($request->validated());

            return response()->json(
                [
                    "message" => "Successfully update product data",
                    "data" => $product,
                ],
                200,
            );
        } catch (\Exception $error) {
            return response()->json(
                [
                    "message" => $error->getMessage(),
                ],
                500,
            );
        }
    }

    public function deleteProductData(Product $product)
    {
        $product->delete();

        return response()->json([
            "message" => "Successfully delete product data",
        ]);
    }
}
