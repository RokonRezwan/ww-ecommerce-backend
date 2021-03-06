<?php

namespace App\Models;

use App\Models\Price;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'category_id',
        'slug',
        'image',
        'description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class)->with('priceTypes');
    }

    public function products()
    {
        return $this->belongsTo(OrderDetails::class);
    }

    public function scopeOrderByIdDescending($query)
    {
        return $query->orderBy('id', 'DESC');
    }

    public function scopeFilterIsActive($query)
    {
        return $query->where('is_active', true);
    }
}
