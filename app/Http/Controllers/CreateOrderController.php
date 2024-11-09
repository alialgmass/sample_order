<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Services\OrderService;
use Illuminate\Http\JsonResponse;

class CreateOrderController extends BaseController
{
    public function __invoke(CreateOrderRequest $request, OrderService $orderService): JsonResponse
    {
        $validated = $request->validated();
        $orderService->createOrder($validated);

        return $this->getResponse(200);
    }
}
