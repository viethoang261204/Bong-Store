<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm khách hàng</title>
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
        .avatar {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
        .password-container {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            top: 70%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
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

        <h1 class="dm">Thêm khách hàng</h1>
        <form action="/admin/customers/save" method="post" enctype="multipart/form-data" class="container my-5 py-4 border rounded shadow" style="max-width: 900px;" onsubmit="return validateForm()">
            @csrf
            <div class="form-container">
                <div class="form-column left">
                    <div class="avatar-wrapper">
                        <img id="avatar" src="/assets/imgs/default1.jpg" alt="Avatar" class="avatar">
                    </div>
                    <button class="edit-avatar-btn" type="button" onclick="document.getElementById('edit-avatar-input').click()">Thêm ảnh người dùng</button>
                    <input type="file" id="edit-avatar-input" class="edit-avatar-input" name="image" accept="image/*" style="display: none;" onchange="loadFile(event)">
                </div>

                <div class="form-column">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group password-container">
                        <label for="password">Mật khẩu</label>
                        <input type="password" id="password" name="password" required>
                        <i class="fas fa-eye toggle-password" onclick="togglePassword('password')"></i>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <button type="submit" class="save-btn">Lưu</button>
                </div>

                <div class="form-column">
                    <div class="form-group">
                        <label for="full_name">Tên đầy đủ</label>
                        <input type="text" id="full_name" name="full_name" required>
                    </div>
                    <div class="form-group password-container">
                        <label for="confirm_password">Nhập lại mật khẩu</label>
                        <input type="password" id="confirm_password" name="password_confirmation" required>
                        <i class="fas fa-eye toggle-password" onclick="togglePassword('confirm_password')"></i>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="number" id="phone" name="phone" required>
                    </div>
                    <button type="button" class="exit-btn" onclick="window.location.href='/admin/customers'">Thoát</button>
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

    function togglePassword(id) {
        var input = document.getElementById(id);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }

    function validateForm() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm_password").value;

        if (password !== confirmPassword) {
            alert("Mật khẩu và nhập lại mật khẩu không khớp!");
            return false;
        }
        return true;
    }
</script>
</body>
</html>

