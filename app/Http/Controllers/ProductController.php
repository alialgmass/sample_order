<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends BaseController
{
    public function __construct(protected ProductService $productService) {}

    public function index(): JsonResponse
    {
        $products = $this->productService->getAllProducts($this->pagination);

        return $this->getResponse(200, data: [
            'products' => ProductResource::collection($products),
        ], paginator: $products);

    }

    public function show(Product $product): JsonResponse
    {
        return $this->getResponse(200, data: ['product' => ProductResource::make($product)]);
    }
}
