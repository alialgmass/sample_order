<?php

namespace App\Jobs;

use App\Services\OrderService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $orderData;

    public function __construct(array $orderData)
    {
        $this->orderData = $orderData;
        $this->onQueue('order');
    }

    public function handle(): void
    {
        $orderService = new OrderService;
        $orderService->createOrder($this->orderData);
    }
}
