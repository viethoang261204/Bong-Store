<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/order-list.css">
</head>

<body>
<div class="container">
    @include('sidebar.sidebar')
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
            </div>

            <div class="search">
                <label>
                    <input type="text" placeholder="Tìm kiếm tại đây">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    {{ Auth::user()->full_name }}
                </a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="/sign-out" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>

        <h1>Quản lý đơn hàng</h1>

        <div class="content">

            <div class="order-status-filter">
                <a href="{{ url('/admin/order-list/PENDING') }}" class="btn btn-info btn-sm">Pending</a>
                <a href="{{ url('/admin/order-list/CONFIRMED') }}" class="btn btn-info btn-sm">Confirmed</a>
                <a href="{{ url('/admin/order-list/SHIPPING') }}" class="btn btn-info btn-sm">Shipping</a>
                <a href="{{ url('/admin/order-list/RECEIVED') }}" class="btn btn-info btn-sm">Received</a>
                <a href="{{ url('/admin/order-list') }}" class="btn btn-success btn-sm" style="text-decoration: none">View All</a>
            </div>

            <table class="order-table table-hover table-striped">
                <thead>
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Tên đầy đủ</th>
                    <th class="text-center">Địa chỉ</th>
                    <th class="text-center">Số điện thoại</th>
                    <th class="text-center">Tổng tiền</th>
                    <th class="text-center">Trạng thái</th>
                    <th colspan="3" class="text-center">Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $obj)
                    <tr>
                        <td class="text-center">{{ $obj->id }}</td>
                        <td class="text-center">{{ $obj->full_name }}</td>
                        <td class="text-center">{{ $obj->address }}</td>
                        <td class="text-center">{{ $obj->phone }}</td>
                        <td class="text-center">{{ $obj->total }}</td>
                        <td class="text-center">{{ $obj->status }}</td>
                        <td class="text-center">
                            <a href="{{ url('/admin/order-details/'.$obj->id) }}" class="btn btn-outline-info btn-sm">Details</a>
                        </td>

                        @if($obj->status === 'PENDING')
                            <td class="text-center">
                                <a href="{{ url('/admin/order-update-status/'.$obj->id.'/CONFIRMED') }}" class="btn btn-outline-success btn-sm">Confirm</a>
                            </td>
                            <td class="text-center">
                                <a href="{{ url('/admin/order-update-status/'.$obj->id.'/CANCELED') }}" class="btn btn-outline-danger btn-sm">Cancel</a>
                            </td>
                        @endif
                        @if($obj->status === 'CONFIRMED')
                            <td class="text-center">
                                <a href="{{ url('/admin/order-update-status/'.$obj->id.'/SHIPPING') }}" class="btn btn-outline-warning btn-sm">Shipping</a>
                            </td>
                        @endif
                        @if($obj->status === 'SHIPPING')
                            <td class="text-center">
                                <a href="{{ url('/admin/order-update-status/'.$obj->id.'/RECEIVED') }}" class="btn btn-outline-warning btn-sm">Received</a>
                            </td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="/assets/js/main.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
