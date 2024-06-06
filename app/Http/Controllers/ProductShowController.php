<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductShowController
{
    public function showByCategory($categoryName)
    {
        // Get the category ID based on the category name
        $category = DB::table('category')->where('category_name', $categoryName)->first();
        if (isset($category)) {
            // Get all products with the matching category ID
            $products = DB::table('product')->where('categoryid', $category->id)->get();

            // Return the view with the products and category data
            return view('user.showproducts', compact('products', 'category'));
        } else {
            // Return a 404 error or a custom error page if the category is not found
            abort(404);
        }
    }
}
