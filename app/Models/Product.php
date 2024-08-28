<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'manufacturer',
        'price',
        'stock',
        'category_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $orderItems = $product->orderItems()->with('order')->get();

            foreach ($orderItems as $item) {
                $order = $item->order;

                if ($order->status !== 'cancelled') {
                    $order->status = 'cancelled';
                    $order->save();
                }
            }
        });
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
