<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'items';

    protected $primaryKey = 'Item_id';

    public $timestamps = false;

    protected $fillable = [
        'Category_id',
        'Brand_id',
        'Name',
        'Price',
        'OldPrice',
        'Stock_quantity',
        'Description',
        'Image_path'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'Brand_id', 'brand_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'Category_id', 'category_id');
    }

    public function specifications()
    {
        return $this->hasMany(Specification::class, 'Item_id', 'Item_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'Item_id', 'Item_id')->orderBy('Date', 'desc');
    }
}