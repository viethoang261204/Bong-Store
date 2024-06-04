<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

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
}


