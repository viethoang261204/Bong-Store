<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5 d-flex justify-content-between align-items-center sticky-navbar"> <!-- Thêm class sticky-navbar -->
        <!-- Logo -->
        <div class="col-lg-3 d-none d-lg-block">
            <a href="" class="text-decoration-none">
                <a href="/home" class="m-0 display-5 font-weight-semi-bold">
                    <img class="img-fluid w-50" src="/t/img/logo.png" alt="">
                </a>
            </a>
        </div>
        <!-- Navbar -->
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold">
                        <span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper
                    </h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="/home" class="nav-item nav-link">Home</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Products</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a>Top</a>
                                <a href="{{ route('category.show', 'T Shirt') }}" class="dropdown-item">T Shirt</a>
                                <a href="{{ route('category.show', 'Shirt x Polo') }}" class="dropdown-item">Shirt & Polo</a>
                                <a href="{{ route('category.show', 'Jacket') }}" class="dropdown-item">Jacket</a>
                                <a>Bottom</a>
                                <a href="{{ route('category.show', 'Pants') }}" class="dropdown-item">Pants</a>
                                <a href="{{ route('category.show', 'Shorts') }}" class="dropdown-item">Shorts</a>
                                <a>Accessory</a>
                                <a href="{{ route('category.show', 'Bag & Backpack') }}" class="dropdown-item">Bag & Backpack</a>
                                <a href="{{ route('category.show', 'Hat') }}" class="dropdown-item">Hat</a>
                                <a href="{{ route('category.show', 'Others') }}" class="dropdown-item">Others</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Carts</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="/cart" class="dropdown-item">Shopping Cart</a>
                            </div>
                        </div>
                        <a href="/contact" class="nav-item nav-link">Contact</a>
                    </div>
                    <!-- Search and Login -->
                    <div class="d-flex align-items-center">
                        <form action="" class="mr-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for products">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent text-primary">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        @if (Auth::check())
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                                    {{ Auth::user()->full_name }}
                                </a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a href="/order-history" class="dropdown-item">Orders History</a>
                                    <a href="/sign-out" class="dropdown-item">Logout</a>
                                </div>
                            </div>
                        @else
                            <a href="/sign-in" class="nav-item nav-link">Login</a>
                        @endif

                        <a href="/cart" class="btn border">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span class="badge">{{ count(Session::get('cart', [])) }}</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
