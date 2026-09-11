<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Throwable;

class CategoryController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            return response()->json(
                Category::with('products')->get(),
                200
            );
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al consultar las categorías.',
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

            $category = Category::create($validated);

            return response()->json($category, 201);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al crear la categoría.',
            ], 500);
        }
    }

    public function show(Category $category): JsonResponse
    {
        try {
            $category->load('products');

            return response()->json($category, 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al consultar la categoría.',
            ], 500);
        }
    }

    public function update(Request $request, Category $category): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => ['sometimes', 'string', 'max:100'],
                'description' => ['nullable', 'string'],
            ]);

            $category->update($validated);

            return response()->json($category, 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al actualizar la categoría.',
            ], 500);
        }
    }

    public function destroy(Category $category): JsonResponse
    {
        try {
            $category->delete();

            return response()->json([
                'message' => 'Categoría eliminada correctamente.',
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'Error al eliminar la categoría.',
            ], 500);
        }
    }
}