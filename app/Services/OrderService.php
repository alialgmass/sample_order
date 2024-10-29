<?php

namespace App\Services;

use App\Factories\OrderFactory;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\ProductSize;

class OrderService
{
    public function createOrder(array $orderData): Order
    {
        $orderData = $this->prepareOrderData($orderData);
        $order = OrderFactory::create($orderData);

        return $order;
    }

    private function prepareOrderData(array $orderData): array
    {
        $orderData['user_id'] = $this->getAuthenticatedUserId();
        $orderData['items'] = $this->prepareOrderItemData($orderData['items']);
        $orderData['total_price'] = $this->calculateTotalPrice($orderData['items'], $orderData['coupon_code']);

        return $orderData;
    }

    private function getAuthenticatedUserId(): int
    {
        return auth()->user()->id;
    }

    private function prepareOrderItemData(array $items): array
    {
        return array_map(function ($item) {
            return [
                'product_id' => $item['product_id'],
                'product_size_id' => $item['size_id'],
                'product_color_id' => $item['color_id'],
                'quantity' => $item['quantity'],
                'price' => $this->calculateItemPrice($item['size_id']),
            ];
        }, $items);
    }

    private function calculateItemPrice(int $sizeId): float
    {
        $size = ProductSize::findOrFail($sizeId);

        return $size->price;
    }

    private function calculateTotalPrice(array $items, ?string $couponCode): float
    {
        $totalBeforeDiscount = $this->calculateSubtotal($items);

        return $this->applyCoupon($totalBeforeDiscount, $couponCode);
    }

    private function calculateSubtotal(array $items): float
    {
        return collect($items)->sum(fn ($item) => $item['price'] * $item['quantity']);
    }

    private function applyCoupon(float $subtotal, ?string $couponCode): float
    {
        if (empty($couponCode)) {
            return $subtotal;
        }

        $coupon = $this->getValidCoupon($couponCode);
        if ($coupon) {
            $discount = $this->calculateDiscount($subtotal, $coupon->discount_percentage);

            return $subtotal - $discount;
        }

        return $subtotal;
    }

    private function getValidCoupon(string $couponCode): ?Coupon
    {
        return Coupon::where('code', $couponCode)
            ->where('expiration_date', '>=', now())
            ->first();
    }

    private function calculateDiscount(float $totalPrice, float $discountPercentage): float
    {
        return ($totalPrice * $discountPercentage) / 100;
    }
}
