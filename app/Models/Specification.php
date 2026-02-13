<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    protected $table = 'specifications';
    protected $primaryKey = 'Spec_id';
    public $timestamps = false;

    protected $fillable = [
        'Item_id',
        'Name',
        'Value'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'Item_id', 'Item_id');
    }
}