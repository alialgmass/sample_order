<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class ProductImage
 *
 * Represents a image associated with a product.
 *
 * @property int $id The unique identifier for the product image.
 * @property int $product_id The identifier of the associated product.
 * @property string $image_path The path of the image.
 * @property Product $product The product that this image belongs to.
 */
class ProductImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['product_id', 'image_path'];

    /**
     * Get the product that this image belongs to.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
