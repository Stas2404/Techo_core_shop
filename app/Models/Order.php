<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'Order_id';
    public $timestamps = false;

    protected $fillable = [
        'Customer_id',
        'Status_id',
        'Total_sum',
        'OrderDate',
        'DeliveryAddr'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'Order_id', 'Order_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_id', 'Customer_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'Status_id', 'Status_id');
    }
}