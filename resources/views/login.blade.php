<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSA | Login</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" class="icon">
    @include('embed.link')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Google Fonts Roboto -->

    <link rel="stylesheet" href="{{ asset('assets/css/mdb.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

</head>
<style>
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        -webkit-box-shadow: 0 0 0 30px white inset !important;
    }

    .form-outline .error input {
        border-color: red;
    }

    .form-outline .error {
        color: red;
    }

    .example {
        font-size: 14px;
        /* margin-left: -20px; */
        font-style: italic;
    }

    .error {
        color: red;
        /*display: none;*/
    }

    .load {
        display: none;
    }
</style>

<body style="background-color: #fdfdfd">
    <div class="container-fluid">
        <div class="row">
            <div class="right-side col-md-6 text-center d-none d-md-block">
                <div class="logo-con pt-5">
                    <img src="{{ asset('assets/img/white-logo.png') }}" alt="" style="height: 250px; width: 250px;">
                </div>
                <div class="title-con mt-3">
                    <h1 class="text-white">CLSU</h1>
                    <p class="text-white">OFFICE OF STUDENT AFFAIRS</p>
                </div>
                <footer class="footer-left">
                    <p class="text-white">© Copyright. 2023. Central Luzon State University. All Rights Reserved.</p>
                </footer>
            </div>
            <div class="col-md-6 pt-4">
                <div class="form-title">
                    <h3 class="text-center">Login for Student</h3>
                    <p class="text-center">Please provide all information requested below</p>
                </div>

                <div class="form-info container mt-5 px-2">
                    <form method="POST" action="{{ route('login.post') }}" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-12 pt-3">
                                <div class="form-outline">
                                    <input type="email" id="email" class="form-control" name="email" required value="{{ old('email') }}">
                                    <label class="form-label" for="email">Email</label>
                                </div>
                            </div>
                            @if($errors->has('email') || $errors->has('confirm_email'))
                            <p class="error">{{ $errors->first('email') }}{{ $errors->first('confirm_email') }}</p>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-12 pt-3">
                                <div class="form-outline">
                                    <input type="password" class="form-control" id="password" name="password" required value="{{ old('password') }}">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                            </div>
                            <small class="pt-1"></small>
                            @if($errors->has('password') || $errors->has('password_confirmation'))
                            <p class="error">{{ $errors->first('password') }}{{ $errors->first('password_confirmation') }}</p>
                            @endif
                        </div>

                        <div class="pt-2 button-con">
                            <input type="checkbox" onclick="myFunction()" id="show_pass">
                            <label for="show_pass">Show Password</label>
                        </div>

                        <div class="button-con py-4">
                            <a href="{{ route('welcome') }}" class="btn shadow-0">Back</a>
                            <button type="submit" class="btn btn-success shadow-0" name="submit">Login</button>
                        </div>
                        <!-- <div class="button-con py-4 text-center">
                            <button type="submit" class="btn btn-success shadow-0 w-100" name="submit">Login</button>
                        </div> -->

                        <hr>

                        <div class="pt-1 text-center">
                            Don't have an account? <a href="{{ route('register') }}" class="text-success">Register Here</a>
                        </div>
                        <!-- <div class="button-con py-4 justify-content-end d-flex">
                            <a href="{{ route('welcome') }}" class="btn shadow-0">Back</a>
                            <button type="submit" class="btn btn-success shadow-0" name="submit">Login</button>
                        </div> -->
                    </form>
                </div>
            </div>
            <div class="footer-mobile">
                <footer>
                    <p class="m-0">© Copyright 2023 Central Luzon State University All Rights Reserved</p>
                </footer>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/mdb.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
    <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>

    <script type="text/javascript">
        function myFunction() {
            var x = document.getElementById("password");
            var y = document.getElementById("password_confirmation");
            if (x.type === "password") {
                x.type = "text";
                y.type = "text";
            } else {
                x.type = "password";
                y.type = "password";
            }
        }
    </script>
</body>

</html>