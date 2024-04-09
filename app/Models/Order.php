<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        "phone",
        "user_id",
        "payment_type",
        "status_id"
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function status(){
        return DB::table("order_statuses")->find($this->status_id)->first()->name;
    }
    public function products(){
        return DB::table("order_products")->where("order_id", $this->id)->get();
    }

}
