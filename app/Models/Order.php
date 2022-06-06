<?php

namespace App\Models;

use App\Models\OrderDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'order_status_id',
        'order_number',
        'shipping_address',
        'billing_address',
        'promo_discount_amount',
        'tax_amount',
        'shipping_fee',
        'item_sub_total',
        'grand_total',
        'payment_method',
        'payment_status'
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function scopeOrderByIdDescending($query)
    {
        return $query->orderBy('id', 'DESC');
    }
}
