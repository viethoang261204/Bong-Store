Đầu lông bím
Việt Hoàng
<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Registration Form | CodingLab </title>
    <link rel="stylesheet" href="style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
@if (session('success'))
    @include('partials.flashMsgSuccess')
@endif
{{--alert edit fail--}}
@if (session('failed'))
    @include('partials.flashMsgFail')
@endif
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      <form method="POST" action="{{route('user.account.signupProcess')}}" enctype="multipart/form-data">
          @csrf
          
        <div class="user-details">
          <div class="input-box">
            <span class="details">Full Name</span>
            <input type="text" name="full_name" id="full_name" value="{{old('full_name')}}" placeholder="Enter your name" required>
               @if($errors->has('full_name'))
                   {{ $errors->first('full_name')}}
               @endif
          </div>
            
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" name="email" id="email" value="{{old('email')}}" placeholder="Enter your email" required>
              @if($errors->has('email'))
                   {{ $errors->first('email') }}
              @endif
          </div>
            
          <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="number" name="phone" id="phone" value="{{old('phone')}}"placeholder="Enter your number" required>
          </div>

          <div class="input-box">
            <span class="details">Your address</span>
            <input type="text" name="address" id="address" value="{{old('address')}}" placeholder="Enter your address" required>
          </div>
             @if($errors->has('address'))
                {{ $errors->first('address') }}
             @endif
            
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" name="password" id="password" value="{{old('password')}}" placeholder="Enter your password" required>
          </div>
            @if($errors->has('password'))
                {{ $errors->first('password') }}
            @endif
            
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" name="password_2" id="password_2" value="{{old('password_2')}}" placeholder="Confirm your password" required>
          </div>
             @if($errors->has('password_2'))
                {{ $errors->first('password_2') }}
             @endif
        </div>
        
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
