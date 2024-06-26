<?php

namespace App\Models;


class Category extends BaseModel
{

    public $timestamps = false;
    protected $fillable = [
        "name",
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
