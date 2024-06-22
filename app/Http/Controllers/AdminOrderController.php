<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    public function getAll(): View
    {
        $user = auth()->user(); // Lấy thông tin người dùng đăng nhập
        $orders = DB::table("orders")
            ->paginate(10);

        return view("admin.orderlist", [
            "users"=> $user,
            "orders" => $orders,
        ]);
    }

    public function ordersUpdateStatus($id, $status)
    {
        $validStatuses = ['PENDING', 'CONFIRMED', 'SHIPPING', 'RECEIVED', 'CANCELED'];
        if (!in_array($status, $validStatuses)) {
            return redirect('/admin/order-list')->withErrors('Invalid status');
        }

        // Lấy ID người dùng đăng nhập
        $userId = Auth::id();

        // Chỉ cập nhật userid khi trạng thái là RECEIVED
        $updateData = ["status" => $status];
        if ($status === 'RECEIVED') {
            $updateData['userid'] = $userId;
        }

        DB::table("orders")
            ->where("id", $id)
            ->update($updateData);

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

    public function showOrderDetails($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();

        $orderItems = DB::table('order_details')
            ->join('product', 'order_details.product_id', '=', 'product.id')
            ->where('order_details.orders_id', $id)
            ->select('order_details.*', 'product_name as product_name')
            ->get();

        return view('user.order_details', [
            'order' => $order,
            'orderItems' => $orderItems,
        ]);
    }


    public function orderHistory()
    {
        $userId = Auth::id(); // Lấy ID của người dùng đã đăng nhập
        $orders = DB::table('orders')
            ->where('customerid', $userId)
            ->get(); // Lấy tất cả đơn hàng của người dùng này

        return view('/user/orderhistory', ['orders' => $orders]);
    }

    public function cancelOrder($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();

        // Kiểm tra quyền của người dùng
        if ($order->customerid != Auth::id()) {
            abort(403, 'Unauthorized action.');
        }


        if ($order->status === 'PENDING') {
            DB::table('orders')
                ->where('id', $id)
                ->update(['status' => 'CANCELED']);

            return redirect('/order-details/' . $id)->with('success', 'Order has been canceled successfully.');
        }

        return redirect('/order-details/' . $id)->with('error', 'Order cannot be canceled at this stage.');
    }

    public function showdetailsorder($id)
    {
        $order = DB::table('orders')->where('id', $id)->first();

        $orderItems = DB::table('order_details')
            ->join('product', 'order_details.product_id', '=', 'product.id')
            ->where('order_details.orders_id', $id)
            ->select('order_details.*', 'product_name as product_name')
            ->get();

        return view('admin.detailorders', [
            'order' => $order,
            'orderItems' => $orderItems,
        ]);
    }

}
