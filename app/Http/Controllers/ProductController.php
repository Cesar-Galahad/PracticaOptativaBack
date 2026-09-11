<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Throwable;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $products = Product::with(['category', 'brand'])->get();

            return response()->json($products, 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al consultar los productos.',
            ], 500);
        }
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        try {
            $product = Product::create($request->validated());

            $product->load(['category', 'brand']);

            return response()->json($product, 201);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al crear el producto.',
            ], 500);
        }
    }

    public function show(Product $product): JsonResponse
    {
        try {
            $product->load(['category', 'brand']);

            return response()->json($product, 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al consultar el producto.',
            ], 500);
        }
    }

    public function update(
        UpdateProductRequest $request,
        Product $product
    ): JsonResponse {
        try {
            $product->update($request->validated());
            $product->load(['category', 'brand']);

            return response()->json($product, 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al actualizar el producto.',
            ], 500);
        }
    }

    public function destroy(Product $product): JsonResponse
    {
        try {
            $product->delete();

            return response()->json([
                'message' => 'Producto eliminado correctamente.',
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al eliminar el producto.',
            ], 500);
        }
    }
}