<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa người dùng</title>
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

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    {{ Auth::user()->full_name }}
                </a>
                <div class="dropdown-menu rounded-0 m-0">
                    <a href="/sign-out" class="dropdown-item">Logout</a>
                </div>
            </div>
        </div>

        <h1 class="dm">Quản lý người dùng</h1>
        <form action="/admin/users/update/{{ $user->id }}" method="post" enctype="multipart/form-data" class="container my-5 py-4 border rounded shadow" style="max-width: 900px;">
            @csrf
            <div class="form-container">
                <div class="form-column left">
                    <div class="avatar-wrapper">
                        <img id="avatar" src="/assets/imgs/{{$user->image}}" alt="Avatar" class="avatar">
                    </div>
                    <button class="edit-avatar-btn" type="button" onclick="document.getElementById('edit-avatar-input').click()">Chỉnh sửa ảnh đại diện</button>
                    <input type="file" id="edit-avatar-input" class="edit-avatar-input" name="image" accept="image/*" style="display: none;" onchange="loadFile(event)">
                </div>

                <div class="form-column">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="full_name">Tên đầy đủ</label>
                        <input type="text" id="full_name" name="full_name" value="{{ $user->full_name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Vai trò</label>
                        <select id="role" name="role" required>
                            <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Khách hàng</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Quản trị viên</option>
                        </select>
                    </div>
                    <button type="submit" class="save-btn">Lưu</button>
                    <button type="button" class="exit-btn" onclick="window.location.href='/admin/users'">Thoát</button>
                </div>

                <div class="form-column">
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" id="address" name="address" value="{{ $user->address }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" id="phone" name="phone" value="{{ $user->phone }}" required>
                    </div>
                </div>
            </div>
        </form>
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
    function loadFile(event) {
        var output = document.getElementById('avatar');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
        document.getElementById('avatar-form').submit();
    }
</script>
</body>
</html>
