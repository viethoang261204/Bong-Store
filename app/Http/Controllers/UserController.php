<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function getAll()
    {
        $path = "admin/users";
        $users = DB::table("users")->paginate(5);
        Paginator::useBootstrap();
        return view("/admin/userindex", [
            "path" => $path,
            "users" => $users
        ]);
    }

    public function toggleStatus(Request $request, $id) {
        $user = DB::table('users')->where('id', $id)->first();

        if ($user) {
            $newStatus = $user->status === 'active' ? 'inactive' : 'active';

            DB::table('users')
                ->where('id', $id)
                ->update(['status' => $newStatus]);

            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 404);
        }
    }

    public function delete($id){
        DB::table("users")
            ->where("id", $id)
            ->delete();
        return redirect("/admin/users");
    }

    public function edit($id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return view('admin.useredit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'role' => 'required|string|in:admin,customer',
            'status' => 'required|string|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->only(['email', 'full_name', 'phone', 'address', 'role', 'status']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/imgs'), $imageName);

            $oldImage = DB::table('users')->where('id', $id)->value('image');
            if ($oldImage && file_exists(public_path('assets/imgs/' . $oldImage))) {
                unlink(public_path('assets/imgs/' . $oldImage));
            }

            $data['image'] = $imageName;
        }

        DB::table('users')->where('id', $id)->update($data);

        return redirect('/admin/users')->with('success', 'User updated successfully');
    }

    public function add()
    {
        return view("admin.useradd");
    }

    public function save(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'full_name' => 'required|string|max:255',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
            'role' => 'required|string',
            'status' => 'required|string',
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
            'role.required' => 'Vai trò không được để trống',
            'status.required' => 'Tình trạng không được để trống',
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
                'role' => $request->role,
                'status' => $request->status,
            ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/imgs'), $imageName);
                $data['image'] = $imageName;
            }

            DB::table('users')->insert($data);

            return redirect('admin/users')->with('success', 'Thêm người dùng thành công!');
        } catch (\Exception $e) {
            \Log::error('Thêm người dùng thất bại: ', ['error' => $e->getMessage()]);

            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra, vui lòng thử lại.']);
        }
    }

}
