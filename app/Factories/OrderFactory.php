<?php

namespace App\Factories;

use App\Models\Order;
use App\Models\OrderItem;

class OrderFactory
{
    public static function create(array $orderData): Order
    {
        $order = self::createOrder($orderData);
        self::createOrderItems($order, $orderData['items']);

        return $order;
    }

    private static function createOrder(array $orderData): Order
    {
        return Order::create([
            'user_id' => $orderData['user_id'],
            'total_price' => $orderData['total_price'],
        ]);
    }

    private static function createOrderItems(Order $order, array $items): void
    {
        $orderItems = array_map(function ($item) use ($order) {
            return [
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_size_id' => $item['product_size_id'],
                'product_color_id' => $item['product_color_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ];
        }, $items);

        OrderItem::insert($orderItems);
    }
}
