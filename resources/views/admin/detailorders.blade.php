<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết Đơn Hàng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/order-list.css">
</head>
<style>
    .order-details {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        margin-top: 20px;
    }

    .order-details h1, .order-details h3 {
        color: #333;
        margin-bottom: 15px;
    }

    .order-details p {
        font-size: 16px;
        color: #666;
        line-height: 1.5;
    }

    .order-details .table {
        width: 100%;
        margin-top: 10px;
        border-collapse: collapse;
    }

    .order-details .table th, .order-details .table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    .order-details .table th {
        background-color: #f8f9fa;
    }

    .order-details .btn {
        display: inline-block;
        font-size: 16px;
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        margin-top: 20px;
        text-decoration: none;
        border-radius: 5px;
    }

    .order-details .btn:hover {
        background-color: #0056b3;
    }

</style>
<body>
<div class="container">
    @include('sidebar.sidebar')
    <div class="main">
        <div class="topbar">
            <div class="toggle">
                <ion-icon name="menu-outline"></ion-icon>
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

        <div class="order-details">
            <h1>Chi tiết Đơn Hàng</h1>
            <h3>Thông tin đơn hàng</h3>
            <div>
                <p>Order ID: {{ $order->id }}</p>
                <p>Full name: {{ $order->full_name }}</p>
                <p>Address: {{ $order->address }}</p>
                <p>Phone: {{ $order->phone }}</p>
                <p>Total: {{ number_format($order->total) }} VND</p>
                <p>Status: {{ $order->status }}</p>
                <p>Time: {{ $order->created_at }}</p>
            </div>
            <h3>Sản phẩm</h3>
            <table class="table">
                <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Price (VND)</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orderItems as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price) }} VND</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <a href="/admin/order-list" class="btn btn-primary">Back to list</a>
        </div>
    </div>
</div>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script src="/assets/js/main.js"></script>
<script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
