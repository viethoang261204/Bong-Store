<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class DetailsController
{
    public function detailsindex($id)
    {
        $products = DB::table("product")->where("id", $id)-> get();
        $likeproducts = DB::table("product")->take(4)->get();
        return view("/user/detailsindex",['likeproducts' => $likeproducts, 'products' => $products]);
    }
}
