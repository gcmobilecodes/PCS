{{-- @extends('layouts.app')

@section('content') --}}
<html>
<head>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('assets/cs/style.css')}}"></head>
    <link rel="stylesheet" href=
    "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
        <link rel="stylesheet" href=
    "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity=
    "sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous">
<body>
    <div class="container ">
        <div class="formdiv ">
          <center>  <h1>Login</h1></center>
               <form method="POST" action="{{ route('login') }}">
                @csrf
               {{-- <div class="form-floating mb-3 ">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <label for="email" class=" floatingInput fcol-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div> --}}
           <div class="form-floating mb-3 ">
                <input id="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number') }}" required autocomplete="mobile_number" autofocus>
                <label for="mobile_number" class=" floatingInput fcol-md-4 col-form-label text-md-end">{{ __('mobile_number') }}</label>
                @error('mobile_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="form-floating ">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"   required autocomplete="current-password "  >


            <label for="floatingPassword">{{ __('Password') }} </label>
                <i class="bi bi-eye-slash "
                id="togglePassword"></i>
                @error('password')


                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>


           {{-- <div class="ckeckboxx">
                <input class="form-check-input" type="checkbox"  id='toggle' value='0' onchange='togglePassword(this);'>
                &nbsp; <span id='toggleText'>Show</span>

              </div> --}}




           <button class="btn btn w-100 pb-3  mt-3 pt-3 btn-primary" type="submit" id="sbutton">  {{ __('Login') }}</button></a>
            @if (Route::has('password.request'))
          <center>  <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a></center>
        @endif


        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
<script>
    // function togglePassword(el){

    //  // Checked State
    //  var checked = el.checked;

    //  if(checked){
    //   // Changing type attribute
    //   document.getElementById("password").type = 'text';

    //   // Change the Text
    //   document.getElementById("toggleText").textContent= "Hide";
    //  }else{
    //   // Changing type attribute
    //   document.getElementById("password").type = 'password';

    //   // Change the Text
    //   document.getElementById("toggleText").textContent= "Show";
    //  }

    // }
    const togglePassword = document
            .querySelector('#togglePassword');

        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', () => {

            // Toggle the type attribute using
            // getAttribure() method
            const type = password
                .getAttribute('type') === 'password' ?
                'text' : 'password';

            password.setAttribute('type', type);

            // Toggle the eye and bi-eye icon
            this.classList.toggle('bi-eye');
        });

        </script>

</html>

