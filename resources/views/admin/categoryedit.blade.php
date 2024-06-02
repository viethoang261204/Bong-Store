<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
                    <input type="text" placeholder="Search here">
                    <ion-icon name="search-outline"></ion-icon>
                </label>
            </div>

            <div class="user">
                <img src="/assets/imgs/customer01.jpg" alt="">
            </div>
        </div>

        <form action="{{ url('/admin/category/update/' . $category->id) }}" method="post" class="edit-category-form container my-5 py-4 border rounded shadow" style="max-width: 500px;">
            @csrf
            @method('POST')

            <h1 class="mb-4 text-center">Sửa Danh Mục</h1>

            <div class="mb-3">
                <input type="text" name="categoryName" id="categoryName" class="form-control form-control-sm" value="{{ $category->category_name }}" />
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Cập Nhật</button>
                <a href="/admin/category" class="btn btn-secondary" style="background-color: #FFA500;text-decoration: none">Hủy</a>
            </div>

        </form>
    </div>
</div>

<!-- =========== Scripts =========  -->
<script src="/assets/js/main.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<!-- SweetAlert for success message -->
@if(session('success'))
    <script>
        swal({
            title: "Thành công!",
            text: "{{ session('success') }}",
            icon: "success",
            button: "OK",
        });
    </script>
@endif

@if($errors->any())
    <script>
        swal({
            title: "Lỗi!",
            text: "{{ $errors->first() }}",
            icon: "error",
            button: "OK",
        });
    </script>
@endif

</body>
</html>
