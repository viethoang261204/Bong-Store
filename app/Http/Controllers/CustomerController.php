<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function signUp()
    {
        return view('user.account.signup');
    }

    public function signupProcess(CustomerStoreRequest $request)
    {
        if ($request->validated()) {
            $array = [];
            $array = Arr::add($array, 'name', $request->full_name);
            $array = Arr::add($array, 'email', $request->email);
            $array = Arr::add($array, 'password', Hash::make($request->password));
            $array = Arr::add($array, 'phone', $request->phone);
            $array = Arr::add($array, 'address', $request->address);

            //Lấy dữ liệu từ form và lưu lên db
            Customer::create($array);

            return Redirect::route('user.userindex');
        } else {
            //cho quay về trang login
            return Redirect::back('user.account.signin');
        }
    }

    public function signin()
    {
        session([
            'myUrl' => url()->previous()
        ]);
        return view('user.account.signin');
    }
    
    public function signinProcess(Request $request)
    {
        $accuracy = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'min:6'],
        ]);

        $account = $request->only(['email', 'password']);
        $check = Auth::guard('customer')->attempt($account);

        if ($check) {
            //Lấy thông tin của customer đang login
            $customer = Auth::guard('customer')->user();
            //Cho login
            Auth::guard('customer')->login($customer);
            //Ném thông tin customer đăng nhập lên session
            session(['customer' => $customer]);
            return Redirect::route('user.userindex')->with('success', 'Logged in successfully');
        } else {
            //cho quay về trang login
            return Redirect::back()->with('failed', 'You entered the wrong email or password.')->withInput($request->input());
        }
    }

    public function signOut()
    {
        if (!Auth::guard('customer')->check()) {
            return Redirect::route('user.userindex')->with('success', 'Logged out successfully !');
        }
        Auth::guard('customer')->logout();
        session()->forget('customer');
        return view('user.userindex');
    }
    
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
