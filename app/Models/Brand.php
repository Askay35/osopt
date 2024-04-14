<?php

namespace App\Models;

class Brand extends BaseModel
{

    public $timestamps = false;
    protected $fillable = [
        "name",
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}


