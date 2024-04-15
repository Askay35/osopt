<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

class Product extends BaseModel
{

    public $timestamps = false;
    protected $fillable = [
        "category_id",
        "subcategory_id",
        "name",
        "count",
        "image",
        "price",
        "in_stock"
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

}
