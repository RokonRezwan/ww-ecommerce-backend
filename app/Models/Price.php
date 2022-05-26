<?php

namespace App\Models;

use App\Models\Product;
use App\Models\PriceType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Price extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'price_type_id'
    ];

    /* public function products()
    {
        return $this->belongsTo(Product::class);
    } */

    public function priceTypes()
    {
        return $this->belongsTo(PriceType::class, 'price_type_id');
    }
}
