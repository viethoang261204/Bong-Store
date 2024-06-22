<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Order Detail</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="/t/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/t/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/t/css/style.css" rel="stylesheet">
</head>
<body>
@include('partials.header')

<div class="container mt-5">
    <h1 class="mb-4">Chi tiết Đơn Hàng</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Thông tin Đơn Hàng</h5>
            <p class="card-text"><strong>Order ID:</strong> {{ $order->id }}</p>
            <p class="card-text"><strong>Full name:</strong> {{ $order->full_name }}</p>
            <p class="card-text"><strong>Address:</strong> {{ $order->address }}</p>
            <p class="card-text"><strong>Phone:</strong> {{ $order->phone }}</p>
            <p class="card-text"><strong>Total:</strong> {{ number_format($order->total) }} VND</p>
            <p class="card-text"><strong>Status:</strong> {{ $order->status }}</p>
            <p class="card-text"><strong>Time:</strong> {{ $order->created_at }}</p>
            @if($order->status === 'PENDING')
                <a href="{{ route('order.cancel', $order->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to cancel this order?');">Cancel Order</a>
            @endif
        </div>
    </div>

    <h3 class="mt-4">Sản phẩm</h3>
    <table class="table table-striped">
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
    <a href="/order-history" class="btn btn-primary">Back to list</a>
</div>

@include('partials.footer')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="/t/lib/easing/easing.min.js"></script>
<script src="/t/lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Contact Javascript File -->
<script src="/t/mail/jqBootstrapValidation.min.js"></script>

<!-- Template Javascript -->
<script src="/t/js/main.js"></script>
</body>
</html>
