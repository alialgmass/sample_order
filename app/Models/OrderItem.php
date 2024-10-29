<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class OrderItem
 *
 * Represents an item in an order, linking products, sizes, and colors.
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property int $product_size_id
 * @property int $product_color_id
 * @property int $quantity
 * @property float $price
 * @property Order $order
 * @property Product $product
 * @property ProductSize $productSize
 * @property ProductColor $productColor
 */
class OrderItem extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'product_size_id',
        'product_color_id',
        'quantity',
        'price',
    ];

    /**
     * Get the order that this item belongs to.
     */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product associated with this order item.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the size associated with this order item.
     */
    public function productSize(): BelongsTo
    {
        return $this->belongsTo(ProductSize::class);
    }

    /**
     * Get the color associated with this order item.
     */
    public function productColor(): BelongsTo
    {
        return $this->belongsTo(ProductColor::class);
    }
}
