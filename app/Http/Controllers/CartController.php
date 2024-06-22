<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CartController extends Controller
{
    public function addToCart($id, $quantity)
    {
        if ($quantity <= 0) {
            return redirect('/product-detail/' . $id)->with('error', 'Quantity must be greater than 0.');
        }

        $product = DB::table('product')
            ->where('id', $id)
            ->first();

        if (!$product) {
            return redirect('/product-detail/' . $id)->with('error', 'Product not found.');
        }

        if ($product->stock < $quantity) {
            return redirect('/product-detail/' . $id)->with('error', 'Not enough stock available.');
        }

        $cart = Session::get('cart', []);

        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        $found = false;
        foreach ($cart as $index => $item) {
            if ($item->id == $id) {
                $cart[$index]->quantity += $quantity;  // Cộng dồn số lượng
                $found = true;
                break;
            }
        }

        // Nếu sản phẩm chưa có trong giỏ, thêm mới
        if (!$found) {
            $product->quantity = $quantity;
            array_push($cart, $product);
        }

        Session::put('cart', $cart);

        return redirect('/product-detail/' . $id);
    }




    public function cart()
    {
        $cart = Session::get('cart', []);

        $total = 0;
        foreach ($cart as $product) {
            $total += $product->product_price * $product->quantity;
        }

        return view('user.cart', compact('cart', 'total'));
    }

    public function removeCart($id)
    {
        $cart = Session::get('cart', []);

        foreach ($cart as $key => $product) {
            if ($product->id == $id) {
                unset($cart[$key]);
                break;
            }
        }

        Session::put('cart', $cart);

        return redirect('/cart');
    }

    public function clearCart()
    {
        Session::forget('cart');
        return redirect('/cart');
    }

    public function updateCart($type, $id, $quantity){

        $cart = Session::get('cart');

        foreach ($cart as $key => $value){
            if($value->id == $id && $type == "plus"){
                $cart[$key]->quantity = $quantity + 1 ;
            }

            if ($value->id == $id && $type == "sub"){
                if($quantity > 1){
                    $cart[$key]->quantity =$quantity - 1;
                } else if($quantity == 1 ){
                    unset($cart[$key]);
                }
            }
        }

        Session::put('cart', $cart);
        return redirect('/cart');
    }

    public function checkout() {

        $cart = Session::get("cart");
        if($cart ==null) {
            $cart = [];
        }

        $total =0;
        if(empty($cart)) {
            return redirect("/cart");
        }

        foreach ($cart as $index => $obj) {
            $total += $obj->product_price * $obj->quantity;
        }
        return view("user/checkout",[
            "cart" => $cart,
            "total" => $total,
            "user" => Auth::user()
        ]);
    }

    public function cartCheckout(Request $request)
    {
        $total = $request->total;
        $status = "PENDING";
        $fullName = $request->fullName;
        $address = $request->address;
        $phone = $request->phone;

        // Lấy ID người dùng hiện tại
        $customerid = Auth::id(); // Auth::id() sẽ trả về ID của người dùng đã đăng nhập

        $id = DB::table("orders")
            ->insertGetId([
                "customerid" => $customerid,
                "full_name" => $fullName,
                "address" => $address,
                "phone" => $phone,
                "total" => $total,
                "status" => $status,
                "created_at" => Carbon::now(),
            ]);

        $cart = Session::get('cart');
        foreach ($cart as $obj) {
            // Thêm sản phẩm vào order_details
            DB::table("order_details")
                ->insert([
                    'orders_id' => $id,
                    'product_id' => $obj->id,
                    'price' => $obj->product_price,
                    'quantity' => $obj->quantity,
                    "created_at" => date("Y-m-d H:i:s"),
                ]);

            // Cập nhật số lượng tồn kho
            DB::table("product")
                ->where("id", $obj->id)
                ->decrement("stock", $obj->quantity);
        }

        // Xóa giỏ hàng
        Session::forget("cart");

        return view("/user/checkoutsucces", []);
    }

}


