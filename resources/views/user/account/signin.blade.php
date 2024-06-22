<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Bống Store Login</title>
    <link rel="stylesheet" href="/t/css/signin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
<div class="center">
    <div class="container">
        <label class="close-btn fas fa-times" title="close" onclick="returnToHome()"></label>
        <div class="text">Login</div>

        <form method="post" action="{{ route('user.account.signin') }}" enctype="multipart/form-data">
            @csrf

            <div class="alert-section">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Lỗi!</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('failed'))
                    <div class="alert alert-danger">
                        {{ session('failed') }}
                    </div>
                @endif
            </div>

            <div class="data">
                <label>Enter your email</label>
                <input type="text" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="data">
                <label>Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="btn">
                <div class="inner"></div>
                <button type="submit">Login</button>
            </div>

            <div class="signup-link">
                Not a member? <a href="/sign-up">Signup now</a>
            </div>
        </form>
    </div>
</div>

<script>
    function returnToHome() {
        window.location.href = '/home'; // Chỉnh sửa đường dẫn nếu cần
    }
</script>
</body>
</html>
