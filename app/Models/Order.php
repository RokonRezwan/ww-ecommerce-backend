<?php

namespace App\Models;

use App\Models\OrderDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'total_price',
        'customer_name',
        'customer_email',
        'shipping_address',
        'phone_number',
        'is_delivered'
    ];
    
    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class);
    }
}
