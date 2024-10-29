<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrderRequest;
use App\Jobs\CreateOrderJob;
use Illuminate\Http\JsonResponse;

class CreateOrderController extends BaseController
{
    public function __invoke(CreateOrderRequest $request): JsonResponse
    {
        $validated = $request->validated();
        CreateOrderJob::dispatchSync($validated);

        return $this->getResponse(200);
    }
}
