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
}
