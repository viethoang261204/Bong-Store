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
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign(['userid'], 'FK_orders_users')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['customerid'], 'FK_orders_users_2')->references(['id'])->on('users')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('FK_orders_users');
            $table->dropForeign('FK_orders_users_2');
        });
    }
};
