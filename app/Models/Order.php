<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Order
 *
 * @property int $user_id The ID of the user who placed the order
 * @property float $total_price The total price of the order
 * @property \Illuminate\Support\Carbon $created_at The timestamp when the order was created
 * @property \Illuminate\Support\Carbon $updated_at The timestamp when the order was last updated
 */
class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'total_price'];

    /**
     * Get the items associated with the order.
     */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
