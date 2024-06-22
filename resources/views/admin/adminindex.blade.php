<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">

</head>
<style>
    /* Style for navbar item */
    .nav-item {
        position: relative;
        padding: 10px 15px;
    }

    /* Styling the dropdown link */
    .nav-link {
        color: #fff; /* Adjust color to match your theme */
        background-color: #007bff; /* Blue background */
        padding: 10px 20px;
        border-radius: 5px; /* Rounded corners for the link */
        display: flex;
        align-items: center;
        justify-content: space-between; /* Space between text and dropdown icon */
        text-decoration: none;
        font-size: 16px; /* Larger font size */
    }

    /* Styling the dropdown menu */
    .dropdown-menu {
        position: absolute;
        top: 100%; /* Position directly below the dropdown link */
        left: 0;
        z-index: 1000;
        display: none; /* Hide by default, shown on click */
        float: none;
        min-width: 160px; /* Set a min-width for the dropdown */
        padding: 5px 0; /* Padding for the dropdown */
        margin: 2px 0 0; /* Margin top */
        font-size: 14px; /* Font size for dropdown items */
        text-align: left;
        list-style: none;
        background-color: #f8f9fa; /* Light background for the dropdown */
        background-clip: padding-box;
        border: 1px solid rgba(0,0,0,.15); /* Subtle border */
        border-radius: 0.25rem;
        box-shadow: 0 2px 5px rgba(0,0,0,.175); /* Shadow for dropdown */
    }

    /* Dropdown item styling */
    .dropdown-item {
        display: block;
        width: 100%; /* Full width */
        padding: 8px 20px;
        clear: both;
        font-weight: 400;
        color: #212529; /* Dark text color for readability */
        text-align: inherit;
        white-space: nowrap;
        background: none;
        border: 0;
        text-decoration: none;
    }

    /* Hover effect for dropdown items */
    .dropdown-item:hover, .dropdown-item:focus {
        color: #16181b;
        text-decoration: none;
        background-color: #f8f9fa; /* Light grey background on hover */
    }

    /* Show the dropdown menu on hover */
    .nav-item:hover .dropdown-menu {
        display: block;
    }

    /* Adding a little arrow icon next to the username */
    .nav-link::after {
        content: '\25bc'; /* Downward arrow */
        font-size: 12px;
        margin-left: 10px;
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

            <!-- User dropdown menu -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    {{ Auth::user()->full_name }}
                </a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="/sign-out" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>

        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="cardName">Products</div>
                    <div class="numbers">{{ $productCount }}</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="cube-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="cardName">Category</div>
                    <div class="numbers">{{ $categoryCount }}</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="list-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="cardName">Orders</div>
                    <div class="numbers">{{ $orderCount }}</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="receipt-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="cardName">Earning</div>
                    <div class="numbers">{{ number_format($totalRevenue) }}</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="wallet-outline"></ion-icon>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="/assets/js/main.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<!-- Optional: Include jQuery and Popper JS for Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
