<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        "category_id",
        "subcategory_id",
        "name",
        "desc",
        "price",
        "weight",
        "count",
        "min_order_price",
        "in_stock"
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
