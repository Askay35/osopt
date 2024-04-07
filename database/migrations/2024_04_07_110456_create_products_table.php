<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->foreignId('subcategory_id');
            $table->string("name");
            $table->string("desc", 250)->nullable();
            $table->float("price");
            $table->float("weight")->nullable();
            $table->integer("count")->default(1);
            $table->float("min_order_price")->default(0);
            $table->boolean('in_stock')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
