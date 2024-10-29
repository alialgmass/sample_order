<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProductColor
 *
 * Represents a color associated with a product.
 *
 * @property int $id The unique identifier for the product color.
 * @property int $product_id The identifier of the associated product.
 * @property string $color_name The name of the color.
 * @property Product $product The product that this color belongs to.
 */
class ProductColor extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'color_name'];

    /**
     * Get the product that this color belongs to.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
