<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    public $timestamps = false;

    protected $fillable = [
        'Order_id',
        'Item_id',
        'Quantity',
        'Price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'Item_id', 'Item_id');
    }
}