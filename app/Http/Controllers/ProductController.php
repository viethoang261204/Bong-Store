<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    public function getAll()
    {
        $path = "admin/product";
        $products = DB::table('product')
            ->join('category', 'product.categoryid', '=', 'category.id')
            ->select('product.*', 'category_name as category_name')
            ->paginate(5);
        Paginator::useBootstrap();
        return view("admin.productindex", [
            "path" => $path,
            "products" => $products
        ]);
    }

    public function delete($id){
        DB::table("product")
            ->where("id", $id)
            ->delete();
        return redirect("/admin/product");
    }

    public function edit($id) {
        $path = "admin/productedit";
        // Lấy thông tin sản phẩm
        $product = DB::table('product')
            ->where('id', $id)
            ->first();

        // Lấy danh sách các danh mục
        $categories = DB::table('category')->get();

        return view('admin/productedit', [
            "path" => $path,
            "product" => $product,
            "categories" => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        // Xác thực các trường dữ liệu
        $request->validate([
            'product_id' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'details' => 'required|string',
            'product_price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|integer|exists:category,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra nếu có hình ảnh mới
        ], [
            'product_id.required' => 'Mã sản phẩm không được để trống',
            'product_name.required' => 'Tên sản phẩm không được để trống',
            'details.required' => 'Mô tả sản phẩm không được để trống',
            'product_price.required' => 'Giá sản phẩm không được để trống',
            'product_price.numeric' => 'Giá sản phẩm phải là một số',
            'stock.required' => 'Số lượng tồn kho không được để trống',
            'stock.integer' => 'Số lượng tồn kho phải là một số nguyên',
            'category.required' => 'Danh mục sản phẩm không được để trống',
            'category.exists' => 'Danh mục sản phẩm không hợp lệ',
            'image.image' => 'File tải lên phải là một hình ảnh',
            'image.max' => 'Hình ảnh không được vượt quá 2MB',
        ]);

        try {
            $data = [
                'product_id' => $request->product_id,
                'product_name' => $request->product_name,
                'details' => $request->details,
                'product_price' => $request->product_price,
                'stock' => $request->stock,
                'categoryid' => $request->category,
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/imgs'), $imageName);

                $oldImage = DB::table('product')->where('id', $id)->value('image');
                if ($oldImage && file_exists(public_path('assets/imgs/' . $oldImage))) {
                    unlink(public_path('assets/imgs/' . $oldImage));
                }
                $data['image'] = $imageName;
            }

            DB::table('product')->where('id', $id)->update($data);

            return redirect('admin/product')->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Exception $e) {
            \Log::error('Cập nhật sản phẩm thất bại: ', ['error' => $e->getMessage()]);

            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }

    public function add()
    {
        $path = "admin/product/add";
        $category = DB::table('category')->get(); // Truy vấn danh mục sản phẩm từ cơ sở dữ liệu
        return view("admin/productadd", [
            "path" => $path,
            "category" => $category
        ]);
    }


    public function save(Request $request)
    {
        $request->validate([
            'product_id' => 'required|string|max:255',
            'product_name' => 'required|string|max:255',
            'details' => 'required|string',
            'product_price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|integer|exists:category,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ], [
            'product_id.required' => 'Mã sản phẩm không được để trống',
            'product_name.required' => 'Tên sản phẩm không được để trống',
            'details.required' => 'Mô tả sản phẩm không được để trống',
            'product_price.required' => 'Giá sản phẩm không được để trống',
            'product_price.numeric' => 'Giá sản phẩm phải là một số',
            'stock.required' => 'Số lượng tồn kho không được để trống',
            'stock.integer' => 'Số lượng tồn kho phải là một số nguyên',
            'category.required' => 'Danh mục sản phẩm không được để trống',
            'category.exists' => 'Danh mục sản phẩm không hợp lệ',
            'image.image' => 'File tải lên phải là một hình ảnh',
        ]);

        try {
            $data = [
                'product_id' => $request->product_id,
                'product_name' => $request->product_name,
                'details' => $request->details,
                'product_price' => $request->product_price,
                'stock' => $request->stock,
                'categoryid' => $request->category,
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/imgs'), $imageName);
                $data['image'] = $imageName;
            }

            DB::table('product')->insert($data);

            return redirect('admin/product')->with('success', 'Thêm sản phẩm thành công!');
        } catch (\Exception $e) {
            \Log::error('Thêm sản phẩm thất bại: ', ['error' => $e->getMessage()]);

            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }

}
