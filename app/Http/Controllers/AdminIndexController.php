<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminIndexController extends Controller {
    public function adminindex()
    {
        $user = auth()->user(); // Người dùng đã được xác thực
        $productCount = DB::table('product')->count();
        $categoryCount = DB::table('category')->count();
        $orderCount = DB::table('orders')->count();
        $totalRevenue = DB::table('orders')
            ->where('status', 'RECEIVED')
            ->sum('total');

        return view('admin.adminindex', [
            'user' => $user,
            'productCount' => $productCount,
            'categoryCount' => $categoryCount,
            'orderCount' => $orderCount,
            'totalRevenue' => $totalRevenue
        ]);
    }

}

