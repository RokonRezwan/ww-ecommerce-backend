<?php

namespace App\Models;

use App\Models\Price;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PriceType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function priceType()
    {
        return $this->belongsTo(Price::class);
    }

    public function scopeOrderByIdDescending($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopeFilterIsActive($query)
    {
        return $query->where('is_active', 1);
    }
}
