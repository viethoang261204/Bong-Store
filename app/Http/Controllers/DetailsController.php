<?php

namespace App\Http\Controllers;

class DetailsController
{
    public function detailsindex()
    {
        $products = DB::table("products")
            -> get();
        return view("/user/detailsindex");
    }
}
