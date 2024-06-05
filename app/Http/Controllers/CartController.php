<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CartController extends Controller
{
    public function addToCart($id, $quantity)
    {
        $product = DB::table('product')
            ->where('id', $id)
            ->first();
        $product->quantity = $quantity;
        $cart = $product;
        Session::push("cart", $cart);
        return redirect('/product-detail/'.$id);
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
        ]);
    }

    public function cartCheckout(Request $request) {

        $total = $request->total;
        $status = "PENDING";
        $fullName = $request->fullName;
        $address = $request->address;
        $phone = $request->phone;

        $id = DB::table("orders")
            ->insertGetId([
                "full_name" => $fullName,
                "address" => $address,
                "phone" => $phone,
                "total" => $total,
                "status" => "PENDING",
                "created_at" => date("Y-m-d H:i:s"),
            ]);

        // them san pham, quantity, price vao order_detail
        $cart = Session::get('cart');
        foreach ($cart as $obj){
            DB::table("order_details")
                ->insert([
                    'orders_id' => $id,
                    'product_id' => $obj->id,
                    'price' => $obj->product_price,
                    'quantity' => $obj->quantity,
                    "created_at" => date("Y-m-d H:i:s"),
                ]);
        }

        // cap nhat so luong san pham trong kho
//        foreach ($cart as $obj){
//            DB::table("product")
//                ->where("id", $obj->id)
//                ->update([
//                    "stock" => $obj->stock - $obj->quantity,
//                ]);
//        }

        //Xóa giỏ hàng
        {
            Session::forget("cart");
        }

        return view("/user/checkoutsucces",[]);
    }


}


