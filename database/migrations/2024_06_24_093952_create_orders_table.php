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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('full_name');
            $table->string('address');
            $table->string('phone');
            $table->integer('total');
            $table->enum('status', ['PENDING', 'CONFIRMED', 'SHIPPING', 'RECEIVED', 'CANCELED']);
            $table->integer('userid')->nullable()->index('fk_orders_users');
            $table->integer('customerid')->nullable()->index('fk_orders_users_2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
