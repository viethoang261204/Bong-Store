<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
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

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    {{ Auth::user()->full_name }}
                </a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="/sign-out" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>

        <h1 class="dm">Quản lý sản phẩm</h1>
        <div class="category-table">
            <table>
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng tồn kho</th>
                    <th>Loại</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $obj)
                    <tr>
                        <td>{{$obj->id}}</td>
                        <td>{{$obj->product_id}}</td>
                        <td>{{$obj->product_name}}</td>
                        <td>{{number_format($obj->product_price)}}</td>
                        <td>{{number_format($obj->stock)}}</td>
                        <td>{{$obj->category_name}}</td>
                        <td>
                            <a href="/admin/product/edit/{{$obj->id}}" class="edit-btn">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="/admin/product/delete/{{$obj->id}}" class="delete-btn" data-id="{{$obj->id}}" >
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>

                    </tr>

                @endforeach
                </tbody>

                <td colspan="4" style="text-align: center;">
                    {{ $products->onEachSide(1)->links() }}
                </td>
            </table>
            <a id="btn-open" href="/admin/product/add" style="text-decoration: none" >
                 Thêm sản phẩm
            </a>
        </div>
    </div>

</div>

<!-- =========== Scripts =========  -->
<script src="/assets/js/main.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(event) {
            event.preventDefault();
            const productId = this.getAttribute('data-id');
            swal({
                title: "Bạn có muốn xóa sản phẩm này?",
                text: "Sau khi xóa, bạn sẽ không thể khôi phục sản phẩm này!",
                icon: "warning",
                dangerMode: true,
                buttons: {
                    confirm: {
                        text: "OK",
                        value: true,
                        visible: true,
                        className: "",
                        closeModal: true
                    },
                    cancel: {
                        text: "Hủy",
                        value: null,
                        visible: true,
                        className: "",
                        closeModal: true,
                    }
                }
            })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = `/admin/product/delete/${productId}`;
                    }
                });
        });
    });
</script>

</body>
</html>
