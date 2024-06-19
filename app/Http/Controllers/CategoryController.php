<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Pagination\Paginator;

class CategoryController extends Controller
{
    public function getAll()
    {
        $path = "admin/category";
        $categories = DB::table('category')
            ->leftJoin('product', 'category.id', '=', 'product.categoryid')
            ->select('category.id', 'category.category_name', DB::raw('COUNT(product.id) as products_count'))
            ->groupBy('category.id', 'category.category_name')
            ->paginate(5);

        Paginator::useBootstrap();

        return view('admin.categoryindex', [
            'path' => $path,
            'categories' => $categories
        ]);
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'categoryName' => 'required|string|max:255|unique:category,category_name',
        ], [
            'categoryName.required' => 'Tên danh mục không được để trống',
            'categoryName.unique' => 'Tên danh mục này đã tồn tại!',
        ]);

        try {
            $categoryName = $validatedData['categoryName'];
            DB::table("category")->insert([
                "category_name" => $categoryName
            ]);
            return redirect("admin/category")->with('success', 'Thêm danh mục thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }


    public function delete($id){
        DB::table("category")
            ->where("id", $id)
            ->delete();
        return redirect("/admin/category");
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'categoryName' => [
                'required',
                'string',
                'max:255',
                Rule::unique('category', 'category_name')->ignore($id),
            ],
        ], [
            'categoryName.required' => 'Tên danh mục không được để trống',
            'categoryName.unique' => 'Tên danh mục này đã tồn tại !'
        ]);

        try {
            DB::table('category')
                ->where('id', $id)
                ->update([
                    'category_name' => $request->categoryName,
                ]);
            return redirect('admin/category')->with('success', 'Cập nhật danh mục thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }

    public function edit($id) {
        $path = "admin/categoryedit";
        $category = DB::table('category')
            ->where('id', $id)
            ->first();

        return view('admin/categoryedit', [
            "path" => $path,
            "category" => $category
        ]);
        $category = Category::findOrFail($id);
        return view('admin/category', compact('category'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $categories = DB::table('category')
            ->leftJoin('product', 'category.id', '=', 'product.categoryid')
            ->select('category.id', 'category.category_name', DB::raw('COUNT(product.id) as products_count'))
            ->where('category.category_name', 'LIKE', '%' . $searchTerm . '%')
            ->groupBy('category.id', 'category.category_name')
            ->paginate(5);

        return view('admin.categoryindex', [
            'categories' => $categories,
            'searchTerm' => $searchTerm
        ]);
    }


}

