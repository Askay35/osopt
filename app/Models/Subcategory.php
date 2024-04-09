<?php

namespace App\Models;

class Subcategory extends BaseModel
{

    public $timestamps = false;
    protected $fillable = [
        "category_id",
        "name"
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
