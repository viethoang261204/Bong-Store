<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    public function getAll():View
    {
        $activeMenu = "order";
        $orders = DB::table("orders")
            ->paginate(10);

        return view("/admin/orderlist", [
            "orders" => $orders,
            "activeMenu" => $activeMenu,
        ]);
    }
}
