<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class UserIndexController
{
    public function userindex()
    {
        $allproducts = DB::table("product")->take(8)->get();
        $latestproducts = DB::table("product")->orderBy('id', 'desc')->take(4)->get();

        return view('user.userindex', ['allproducts' => $allproducts, 'latestproducts' => $latestproducts]);
    }
}
