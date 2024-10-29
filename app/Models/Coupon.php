<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Coupon

 *
 * @property int $id The unique identifier for the coupon
 * @property string $code The unique code of the coupon
 * @property float $discount_percentage The discount percentage applied when the coupon is used
 * @property \Illuminate\Support\Carbon $expiration_date The date when the coupon expires
 * @property \Illuminate\Support\Carbon $created_at The timestamp when the coupon was created
 * @property \Illuminate\Support\Carbon $updated_at The timestamp when the coupon was last updated
 */
class Coupon extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'discount_percentage', 'expiration_date'];
}
