@extends('backend.layout.template')

@section('icon')
    <link rel="icon" type="image/png" href="{{ asset('cslog/images/boy.png') }}">
@endsection

@section('title')
    {{ 'Admin-Login' }}
@endsection

@section('css')
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('cslog/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('cslog/vendor/animate/animate.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('cslog/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('cslog/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('cslog/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('cslog/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('cslog/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('cslog/css/main.css') }}">
<!--===============================================================================================-->
@endsection

@section('content')
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-t-85 p-b-20">
                <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                @csrf
                    <span class="login100-form-title p-b-70">
                        Admin - Login
                    </span>
                    <span class="login100-form-avatar">
                    <img src="{{asset('cslog/images/boy.png')}}" alt="AVATAR">
                    </span>
                    @if ($errors->has('email'))
                        <div class="alert alert-danger">
                            <strong>Attention!</strong> Credentials do not match.
                        </div>
                    @endif

                    <div class="wrap-input100 validate-input m-t-85 m-b-35" data-validate = "Enter username">
                        <input class="input100" type="text" name="email" data-validation="length" data-validation-length="min5" placeholder="email" style="text-align: center;">
                        {{-- <span class="focus-input100" data-placeholder="Username"></span> --}}
                    </div>

                    <div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
                        <input class="input100" type="password" name="password" placeholder="password" style="text-align: center;">
                        {{-- <span class="focus-input100" data-placeholder="Password"></span> --}}
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    <ul class="login-more p-t-190">
                        <li class="m-b-8">
                            <span class="txt1">
                                Forgot
                            </span>

                            <a href="#" class="txt2">
                                Username / Password?
                            </a>
                        </li>

                        <li>
                            <span class="txt1">
                                Don’t have an account?
                            </span>

                            <a href="{{route('register')}}" class="txt2">
                                Sign up
                            </a>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>
@endsection

@section('js')
<!--===============================================================================================-->
    <script src="{{ asset('cslog/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('cslog/vendor/bootstrap/js/popper.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('cslog/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('cslog/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('cslog/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('cslog/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
    <script src="{{ asset('cslog/js/main.js') }}"></script>
<!--===============================================================================================-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<!--===============================================================================================-->
<script>
  $.validate({
    lang: 'en'
  });
</script>
@endsection
