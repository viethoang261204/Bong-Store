<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Bong - Shop</title>
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
        <h1 class="font-weight-semi-bold text-uppercase mb-3">{{ $category->category_name }}</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ url('/') }}">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">{{ $category->category_name }}</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3 product-list">
                @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1 product-item" data-price="{{ $product->product_price }}">
                        <div class="card border-0 mb-4">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="/assets/imgs/{{ $product->image}}" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{ $product->product_name }}</h6>
                                <div class="d-flex justify-content-center">
                                    <h6>{{ number_format($product->product_price, 0, ',', '.') }} VND</h6>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-center align-items-center bg-light border" style="height: 100%;">
                                <a href="/product-detail/{{ $product->id }}" class="btn btn-sm text-dark p-0 d-flex align-items-center" style="position: center"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

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
