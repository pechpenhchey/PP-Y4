<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'category_id',
        'price',
        'description',
        'image',
    ];

    protected static function booted()
    {
        static::deleting(function ($product) {
            if ($product->isForceDeleting()) {
                \App\Models\Cart::where('product_id', $product->id)->delete();
            }
        });        
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }    
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    
}
