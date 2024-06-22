<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục sản phẩm</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="/assets/css/style.css">
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

            <form id="search-form" action="/admin/category/search" method="GET" class="form-inline">
                <div class="search">
                    <label>
                        <input type="text" name="search" value="{{ $searchTerm ?? '' }}" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
            </form>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    {{ Auth::user()->full_name }}
                </a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="/sign-out" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>

        <!-- Category Table -->
        <h1 class="dm">Quản lý danh mục</h1>
        <div class="category-table">
            <table>
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Sản phẩm</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $obj)
                    <tr>
                        <td>{{$obj -> id}}</td>
                        <td>{{$obj -> category_name}}</td>
                        <td>{{ $obj->products_count }}</td>
                        <td>
                            <a href="/admin/category/edit/{{$obj->id}}" class="edit-btn">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button class="delete-btn" data-id="{{$obj->id}}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>

                <td colspan="4" style="text-align: center;">
                    {{ $categories->onEachSide(1)->links() }}
                </td>
            </table>

            @if(isset($searchTerm) && $searchTerm != '')
                <button onclick="window.location.href='/admin/category'" style="background-color: #4CAF50; color: white; padding: 10px 20px; text-align: center; font-size: 16px; margin: 4px 2px; border: none; cursor: pointer;">View All</button>

            @else
                <button id="btn-open">Thêm</button>
            @endif
        </div>

        <div id="modal-container">
            <form action="/admin/category/save" method="post">
                @csrf
                <div class="modal" id="modal-demo">
                    <div class="modal-header">
                        <h3>Thêm Danh Mục</h3>
                        <button id="btn-close"><i class="fa-solid fa-xmark"></i></button>
                    </div>
                    <div class="modal-body">
                        <div class="add-category-form">
                            <div class="mb-3">
                                <input type="text" name="categoryName" id="categoryName" class="form-control form-control-sm" />
                            </div>
                            <div class="text-center">
                                <button type="submit" id="btn-save" class="btn btn-primary">Lưu</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<!-- =========== Scripts =========  -->
<script src="/assets/js/main.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- ====== ionicons ======= -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    const btn_open = document.getElementById('btn-open');
    const btn_close = document.getElementById('btn-close');
    const modal_container = document.getElementById('modal-container');
    const modal_demo = document.getElementById('modal-demo');

    btn_open.addEventListener('click', () => {
        modal_container.classList.add('show');
    });

    btn_close.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        modal_container.classList.remove('show');
    });

    modal_container.addEventListener('click', (e) => {
        if (!modal_demo.contains(e.target)) {
            modal_container.classList.remove('show');
        }
    });

    @if(session('success'))
    swal("Thành công!", "{{ session('success') }}", "success");
    @endif

    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-id');
            swal({
                title: "Bạn có muốn xóa danh mục này?",
                text: "Sau khi xóa, bạn sẽ không thể khôi phục danh mục này!",
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
                        window.location.href = `/admin/category/delete/${categoryId}`;
                    }
                });
        });
    });

    const searchForm = document.getElementById('search-form');
    const searchInput = searchForm.querySelector('input[name="search"]');

    searchForm.addEventListener('submit', function(event) {
        if (searchInput.value.trim() === '') {
            event.preventDefault();
            window.location.href = '/admin/category';
        }
    });

</script>
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
