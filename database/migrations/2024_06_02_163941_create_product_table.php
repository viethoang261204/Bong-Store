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
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('product_id', 50)->default('0');
            $table->string('product_name');
            $table->bigInteger('product_price')->default(0);
            $table->unsignedInteger('stock')->default(0);
            $table->string('details')->default('');
            $table->string('image', 50)->nullable();
            $table->unsignedBigInteger('categoryid')->nullable()->default(0)->index('fk_product_category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
