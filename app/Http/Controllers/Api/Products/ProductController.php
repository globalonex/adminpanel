<?php

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Products\CreateProductRequest;
use App\Http\Requests\Api\Products\UpdateProductRequest;
use App\Models\Product;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected ImageService $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }
    /**
     * Retrieve all products
     *
     * @return JsonResponse
     */
    public function index()
    {
        try {
            $products = Product::get();//Product::paginate(10);

            if ($products->isEmpty()) {
                return $this->errorResponse('No products found', 404);
            }

            return $this->successResponse($products, 200);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to retrieve products', 500);
        }
    }

    /**
     * Retrieve a specific product
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);

            return $this->successResponse($product, 200);
        } catch (\Exception $e) {
            return $this->errorResponse('Product not found', 404);
        }
    }

    /**
     * Create a new product
     *
     * @param CreateProductRequest $request
     * @return JsonResponse
     */
    public function store(CreateProductRequest $request)
    {
        try {
            $product = Product::create($request->validated());

            if ($request->hasFile('image')) {
                $image = $this->imageService->uploadImage($request->file('image'));
                $product->image = $image;
            }

            $product->save();

            return $this->successResponse(['product' => $product], 201);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to create product', 500);
        }
    }

    /**
     * Update a specific product
     *
     * @param UpdateProductRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateProductRequest $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $oldImage = $product->image;

            $product->update($request->all());

            if ($request->hasFile('image')) {
                $image = $this->imageService->updateImage($request->file('image'), $oldImage);
                $product->image = $image;
            }

            $product->save();

            return $this->successResponse($product, 200);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to update product', 500);
        }
    }

    /**
     * Delete a specific product
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();

            return $this->successResponse('Product deleted', 200);
        } catch (\Exception $e) {
            return $this->errorResponse('Failed to delete product', 500);
        }
    }
    public function errorResponse($message, $status = 400)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message
        ], $status);
    }

    public function successResponse($data, $status = 200)
    {
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], $status);
    }

}
