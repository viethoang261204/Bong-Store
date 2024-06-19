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
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12">
            <!-- Price Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                <form id="price-filter-form">
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="price-all" data-min="0" data-max="600">
                        <label class="custom-control-label" for="price-all">All Price</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-1" data-min="0" data-max="100000">
                        <label class="custom-control-label" for="price-1">0 - 100k VND</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-2" data-min="100000" data-max="200000">
                        <label class="custom-control-label" for="price-2">100k - 200k VND</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-3" data-min="200000" data-max="300000">
                        <label class="custom-control-label" for="price-3">200k - 300k VND</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-4" data-min="300000" data-max="400000">
                        <label class="custom-control-label" for="price-4">300k - 400k VND</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-5" data-min="400000" data-max="500000">
                        <label class="custom-control-label" for="price-5">400k - 500k VND</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="price-6" data-min="500000" data-max="600000">
                        <label class="custom-control-label" for="price-6">500k - 600k VND</label>
                        <span class="badge border font-weight-normal">120</span>
                    </div>
                    <!-- Filter Button -->
                    <button type="button" class="btn btn-primary mt-3" id="filter-button">Filter</button>
                </form>
            </div>
        </div>
        <!-- Shop Sidebar End -->

        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3">
                @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-12 pb-1 product-item">
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

<script>
    document.getElementById('filter-button').addEventListener('click', function() {
        // Lấy tất cả các checkbox
        const checkboxes = document.querySelectorAll('#price-filter-form input[type=checkbox]:checked');

        // Duyệt qua từng checkbox và lấy giá trị min và max
        let filters = [];
        checkboxes.forEach(function(checkbox) {
            filters.push({min: parseInt(checkbox.dataset.min), max: parseInt(checkbox.dataset.max)});
        });

        // Lọc sản phẩm
        let filteredProducts = products.filter(product => {
            return filters.some(filter => product.product_price >= filter.min && product.product_price <= filter.max);
        });

        // Cập nhật DOM
        const productsContainer = document.querySelector('.row.pb-3');
        productsContainer.innerHTML = ''; // Xóa các sản phẩm hiện tại
        filteredProducts.forEach(product => {
            productsContainer.innerHTML += `...`; // Các bạn sẽ cần thêm code để tạo thẻ HTML cho từng sản phẩm
        });
    });
</script>
</body>

</html>
