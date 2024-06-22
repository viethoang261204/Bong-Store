<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Checkout</title>
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

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Checkout</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Checkout Start -->
<form action="/cart/checkout" method="post">
    @csrf
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div class="mb-4">
                <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Full name</label>
                        <input class="form-control" type="text" name="fullName" placeholder="Nguyen Van A"  required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Address</label>
                        <input class="form-control" type="text" name="address" placeholder="Ha Noi"  required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Mobile No</label>
                        <input class="form-control" type="number" name="phone" placeholder="+123 456 789" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card border-secondary mb-5">
                <div class="card-header bg-secondary border-0">
                    <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                </div>
                <div class="card-body">
                    <h5 class="font-weight-medium mb-3">Products</h5>
                    @foreach($cart as $obj)
                    <div class="d-flex justify-content-between">
                        <p>{{$obj->product_name}}</p>
                        <p>{{$obj->product_price}}</p>
                        <p>{{$obj->quantity}}</p>
                    </div>
                    @endforeach
                    <hr class="mt-0">
                    <div class="d-flex justify-content-between mb-3 pt-1">
                        <h6 class="font-weight-medium">Subtotal</h6>
                        <h6 class="font-weight-medium">{{ number_format($total, 0, ',', '.') }} VND</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">20.000 VND</h6>
                    </div>
                </div>
                <div class="card-footer border-secondary bg-transparent">
                    <div class="d-flex justify-content-between mt-2">
                        <h5 class="font-weight-bold">Total</h5>
                        <input type="hidden" name="total" value="{{ $total }}">
                        <h5 class="font-weight-bold">{{ number_format($total + 20000, 0, ',', '.') }} VND</h5>
                    </div>
                </div>
            </div>
{{--            <div class="card border-secondary mb-5">--}}
{{--                <div class="card-header bg-secondary border-0">--}}
{{--                    <h4 class="font-weight-semi-bold m-0">Payment</h4>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="custom-control custom-radio">--}}
{{--                            <input type="radio" class="custom-control-input" name="payment" id="paypal">--}}
{{--                            <label class="custom-control-label" for="paypal">Cash</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group">--}}
{{--                        <div class="custom-control custom-radio">--}}
{{--                            <input type="radio" class="custom-control-input" name="payment" id="directcheck">--}}
{{--                            <label class="custom-control-label" for="directcheck">Bank Account</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="card-footer border-secondary bg-transparent">
                    <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3" type="submit">Place Order</button>
                </div>
{{--            </div>--}}
        </div>
    </div>
</div>
</form>
<!-- Checkout End -->


@include('partials.footer')
<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->
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

