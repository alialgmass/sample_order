<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Product
 *
 * Represents a product in the system with its associated colors, sizes, and images.
 *
 * @property string $name The name of the product.
 * @property string $description A description of the product.
 * @property ProductSize[] $colors The colors associated with the product.
 * @property ProductSize[] $sizes The sizes associated with the product.
 * @property ProductSize[] $images The images associated with the product.
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * Get the colors associated with the product.
     */
    public function colors(): HasMany
    {
        return $this->hasMany(ProductSize::class);
    }

    /**
     * Get the sizes associated with the product.
     */
    public function sizes(): HasMany
    {
        return $this->hasMany(ProductSize::class);
    }

    /**
     * Get the images associated with the product.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductSize::class);
    }
}
