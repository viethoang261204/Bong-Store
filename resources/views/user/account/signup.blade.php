<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Bống Store Đăng Ký</title>
    <link rel="stylesheet" href="/t/css/signup.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
@if (session('success'))
    @include('partials.flashMsgSuccess')
@endif
@if (session('failed'))
    @include('partials.flashMsgFail')
@endif

<div class="container">
    <div class="title">Registration</div>
    <div class="content">
        <form method="POST" action="{{ route('user.account.signup') }}" enctype="multipart/form-data">
            @csrf
            <div class="user-details">
                <div class="input-box">
                    <span class="details">Full Name</span>
                    <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" placeholder="Enter your name" required>
                    @error('full_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box">
                    <span class="details">Email</span>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Enter your email" required>
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box">
                    <span class="details">Phone Number</span>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Enter your number" required>
                    @error('phone')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box">
                    <span class="details">Your address</span>
                    <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Enter your address" required>
                    @error('address')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box">
                    <span class="details">Password</span>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="input-box">
                    <span class="details">Confirm Password</span>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm your password" required>
                    @error('password_confirmation')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="button">
                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</div>
</body>
</html>

