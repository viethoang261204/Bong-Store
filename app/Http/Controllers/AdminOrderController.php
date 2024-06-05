<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    public function getAll(): View
    {
        $orders = DB::table("orders")
            ->paginate(10);

        return view("admin.orderlist", [
            "orders" => $orders,
        ]);
    }

    public function ordersUpdateStatus($id, $status)
    {
        $validStatuses = ['PENDING', 'CONFIRMED', 'SHIPPING', 'RECEIVED', 'CANCELED'];
        if (!in_array($status, $validStatuses)) {
            return redirect('/admin/order-list')->withErrors('Invalid status');
        }

        DB::table("orders")
            ->where("id", $id)
            ->update([
                "status" => $status
            ]);

        return redirect('/admin/order-list');
    }

    public function filter($status) {
        $activeMenu = "order";
        $orders = DB::table("orders")
            ->where("status", $status)
            ->paginate(10); // Thay thế get() bằng paginate(10)

        return view("/admin/orderList", [
            "orders" => $orders,
            "activeMenu" => $activeMenu,
        ]);
    }
}
