<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProductSize
 *
 * Represents a size associated with a product.
 *
 * @property int $id The unique identifier for the product size.
 * @property int $product_id The identifier of the associated product.
 * @property string $size_path The name of the size.
 * @property Product $product The product that this size belongs to.
 */
class ProductSize extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'size_name'];

    /**
     * Get the product that this size belongs to.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
