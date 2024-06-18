<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function getAll()
    {
        $path = "admin/customers";
        $customers = DB::table("customers")->paginate(5);
        Paginator::useBootstrap();
        return view("/admin/customerindex", [
            "path" => $path,
            "customers" => $customers
        ]);
    }

    public function delete($id){
        DB::table("customers")
            ->where("id", $id)
            ->delete();
        return redirect("/admin/customers");
    }

    public function edit($id)
    {
        $customer = DB::table('customers')->where('id', $id)->first();
        return view('admin.customeredit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['email', 'full_name', 'phone', 'address', 'role', 'status']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/imgs'), $imageName);

            $oldImage = DB::table('customers')->where('id', $id)->value('image');
            if ($oldImage && file_exists(public_path('assets/imgs/' . $oldImage))) {
                unlink(public_path('assets/imgs/' . $oldImage));
            }

            $data['image'] = $imageName;
        }

        DB::table('customers')->where('id', $id)->update($data);

        return redirect('/admin/customers')->with('success', 'Customer updated successfully');
    }

    public function add()
    {
        return view("admin.customeradd");
    }

    public function save(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.confirmed' => 'Mật khẩu và xác nhận mật khẩu không khớp',
            'full_name.required' => 'Tên đầy đủ không được để trống',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.numeric' => 'Số điện thoại phải là một số',
            'address.required' => 'Địa chỉ không được để trống',
            'image.image' => 'File tải lên phải là một hình ảnh',
            'image.max' => 'Hình ảnh không được vượt quá 2MB',
        ]);

        try {
            $data = [
                'email' => $request->email,
                'password' => $request->password,
                'full_name' => $request->full_name,
                'phone' => $request->phone,
                'address' => $request->address,
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/imgs'), $imageName);
                $data['image'] = $imageName;
            }

            DB::table('customers')->insert($data);

            return redirect('admin/customers')->with('success', 'Thêm khác hàng thành công!');
        } catch (\Exception $e) {
            \Log::error('Thêm khách hàng thất bại: ', ['error' => $e->getMessage()]);

            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }
}
