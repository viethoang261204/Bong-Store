<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Order History</title>
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

    <script src="/t/js/jquery.min.js"></script>
</head>
<body>
@include('partials.header')

<div class="container mt-5">
    <h2>Your Order History</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Order ID</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
            <th>Details</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ number_format($order->total) }} VND</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at }}</td>
                <td><a href="/order-details/{{ $order->id }}">View</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

@include('partials.footer')
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="/t/lib/easing/easing.min.js"></script>
<script src="/t/lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Contact Javascript File -->
<script src="/t/mail/jqBootstrapValidation.min.js"></script>
<script src="/t/mail/contact.js"></script>

<!-- Template Javascript -->
<script src="/t/js/main.js"></script>
</body>
</html>
