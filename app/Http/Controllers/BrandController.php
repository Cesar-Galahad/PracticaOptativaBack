<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class BrandController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            return response()->json(
                Brand::with('products')->get(),
                200
            );
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al consultar las marcas.',
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:100'],
                'description' => ['nullable', 'string'],
            ]);

            $brand = Brand::create($validated);

            return response()->json($brand, 201);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al crear la marca.',
            ], 500);
        }
    }

    public function show(Brand $brand): JsonResponse
    {
        try {
            $brand->load('products');

            return response()->json($brand, 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al consultar la marca.',
            ], 500);
        }
    }

    public function update(Request $request, Brand $brand): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => ['sometimes', 'string', 'max:100'],
                'description' => ['nullable', 'string'],
            ]);

            $brand->update($validated);

            return response()->json($brand, 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al actualizar la marca.',
            ], 500);
        }
    }

    public function destroy(Brand $brand): JsonResponse
    {
        try {
            $brand->delete();

            return response()->json([
                'message' => 'Marca eliminada correctamente.',
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al eliminar la marca.',
            ], 500);
        }
    }
}