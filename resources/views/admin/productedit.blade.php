<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <style>
        .form-container {
            display: flex;
            gap: 20px;
        }
        .form-column {
            flex: 1;
        }
        form.container {
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="user-edit">
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

        <h1 class="dm">Chỉnh sửa sản phẩm</h1>
        <form action="/admin/product/update/{{ $product->id }}" method="post" enctype="multipart/form-data" class="container my-5 py-4 border rounded shadow" style="max-width: 900px;">
            @csrf
            <div class="form-container">
                <div class="form-column left">
                    <div class="avatar-wrapper">
                        <img id="avatar" src="/assets/imgs/{{$product->image}}" alt="Avatar" class="avatar">
                    </div>
                    <button class="edit-avatar-btn" type="button" onclick="document.getElementById('edit-avatar-input').click()">Chỉnh sửa ảnh đại diện</button>
                    <input type="file" id="edit-avatar-input" class="edit-avatar-input" name="image" accept="image/*" style="display: none;" onchange="loadFile(event)">
                </div>

                <div class="form-column">
                    <div class="form-group">
                        <label for="product_id">Mã sản phẩm</label>
                        <input type="text" id="product_id" name="product_id" value="{{ $product->product_id }}" required>
                    </div>
                    <div class="form-group">
                        <label for="product_name">Tên sản phẩm</label>
                        <input type="text" id="product_name" name="product_name" value="{{ $product->product_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="details">Mô tả sản phẩm</label>
                        <input type="text" id="details" name="details" value="{{ $product->details }}" required>
                    </div>
                    <button type="submit" class="save-btn">Lưu</button>
                </div>

                <div class="form-column">
                    <div class="form-group">
                        <label for="product_price">Giá</label>
                        <input type="text" id="product_price" name="product_price" value="{{ $product->product_price }}" required>
                    </div>
                    <div class="form-group">
                        <label for="stock">Số lượng tồn kho</label>
                        <input type="text" id="stock" name="stock" value="{{ $product->stock }}" required>
                    </div>
                    <div class="form-column">
                        <div class="form-group">
                            <label for="category">Danh mục</label>
                            <select id="category" name="category" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->categoryid == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="button" class="exit-btn" onclick="window.location.href='/admin/product'">Thoát</button>
                </div>
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
<script>
    function loadFile(event) {
        var output = document.getElementById('avatar');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    }
</script>
</body>
</html>
