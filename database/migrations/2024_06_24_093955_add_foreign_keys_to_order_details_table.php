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
        Schema::table('order_details', function (Blueprint $table) {
            $table->foreign(['orders_id'], 'FK_order_details_orders')->references(['id'])->on('orders')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['product_id'], 'FK_order_details_product')->references(['id'])->on('product')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropForeign('FK_order_details_orders');
            $table->dropForeign('FK_order_details_product');
        });
    }
};
