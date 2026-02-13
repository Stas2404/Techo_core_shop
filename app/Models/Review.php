<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $primaryKey = 'Review_id';
    public $timestamps = false; 

    protected $fillable = [
        'Item_id',
        'Customer_id',
        'Rating',
        'Comment',
        'Date'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_id', 'Customer_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'Item_id', 'Item_id');
    }
}