<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OSA | Register Account</title>
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

    .showbtn {
        /*display: flex;*/
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
                    <h3 class="text-center">Registration for Student</h3>
                    <p class="text-center">Please provide all information requested below</p>
                </div>

                <div class="form-info container mt-5 px-2">
                    <h6>Personal information</h6>
                    <form method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-4 pt-1">
                                <div class="form-outline">
                                    <input type="text" id="student_id" class="form-control" name="student_id" required value="{{ old('student_id') }}">
                                    <label class="form-label" for="student_id">Student ID</label>
                                </div>
                            </div>
                            <div class="col pt-1">
                                <p class="example">(Ex.Student ID 00-0000)</p>
                            </div>
                            @if($errors->has('student_id'))
                            <p class="error">{{ $errors->first('student_id') }}</p>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-12 pt-3">
                                <div class="form-outline">
                                    <input type="text" id="fullname" class="form-control" name="fullname" required value="{{ old('fullname') }}">
                                    <label class="form-label" for="fullname">Full Name</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-7 pt-3">
                                <select class="form-select" name="college" id="college" required>
                                    <option selected disabled>Choose your college</option>
                                    <option value="COLLEGE OF AGRICULTURE">COLLEGE OF AGRICULTURE</option>
                                    <option value="COLLEGE OF ARTS AND SOCIAL SCIENCES">COLLEGE OF ARTS AND SOCIAL SCIENCES</option>
                                    <option value="COLLEGE OF BUSINESS ADMINISTRATION AND ACCOUNTANCY">COLLEGE OF BUSINESS ADMINISTRATION AND ACCOUNTANCY</option>
                                    <option value="COLLEGE OF EDUCATION">COLLEGE OF EDUCATION</option>
                                    <option value="COLLEGE OF ENGINEERING">COLLEGE OF ENGINEERING</option>
                                    <option value="COLLEGE OF FISHERIES">COLLEGE OF FISHERIES</option>
                                    <option value="COLLEGE OF HOME SCIENCE AND INDUSTRY">COLLEGE OF HOME SCIENCE AND INDUSTRY</option>
                                    <option value="COLLEGE OF VETERINARY SCIENCE AND MEDICINE">COLLEGE OF VETERINARY SCIENCE AND MEDICINE</option>
                                    <option value="COLLEGE OF SCIENCE">COLLEGE OF SCIENCE</option>
                                </select>
                            </div>
                            <div class="col-md-5 pt-3">
                                <select class="form-select" name="course" id="course" required>
                                    <option selected disabled>Choose your course</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 pt-3">
                                <select class="form-select" name="gender" id="gender" required>
                                    <option selected disabled>Choose your gender</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 pt-3">
                                <div class="form-outline">
                                    <input type="email" id="email" class="form-control" name="email" required value="{{ old('email') }}">
                                    <label class="form-label" for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-md-6 pt-3">
                                <div class="form-outline">
                                    <input type="email" id="confirm_email" class="form-control" name="confirm_email" required value="{{ old('confirm_email') }}">
                                    <label class="form-label" for="confirm_email">Confirm Email</label>
                                </div>
                            </div>
                            @if($errors->has('email') || $errors->has('confirm_email'))
                            <p class="error">{{ $errors->first('email') }}{{ $errors->first('confirm_email') }}</p>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col-md-6 pt-3">
                                <div class="form-outline">
                                    <input type="password" class="form-control" id="password" name="password" required value="{{ old('password') }}">
                                    <label class="form-label" for="password">Password</label>
                                </div>
                            </div>
                            <div class="col-md-6 pt-3">
                                <div class="form-outline">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required value="{{ old('password_confirmation') }}">
                                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                                </div>
                            </div>
                            <small class="pt-1"><em>Note: Please input a password with a combination of lowercase and uppercase letters, a number, and a symbol.</em></small>
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
                            <button type="submit" class="btn btn-success shadow-0" name="submit">Register</button>
                        </div>
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

    @if(session('status_registered'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Email Sent',
            text: 'A confirmation email has been sent to your email address.',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ route('
                welcome ') }}';
            }
        });
    </script>
    @endif

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

        $(document).ready(function() {
            $("#college").change(function() {
                var val = $(this).val();
                if (val == "COLLEGE OF AGRICULTURE") {
                    $("#course").html("<option value='Bachelor of Science in Agribusiness'>Bachelor of Science in Agribusiness</option><option value='Bachelor of Science in Agriculture'>Bachelor of Science in Agriculture</option>");
                } else if (val == "COLLEGE OF ARTS AND SOCIAL SCIENCES") {
                    $("#course").html("<option value='Bachelor of Arts in Filipino'>Bachelor of Arts in Filipino</option><option value='Bachelor of Arts in Literature'>Bachelor of Arts in Literature</option><option value='Bachelor of Arts in Social Sciences'>Bachelor of Arts in Social Sciences</option><option value='Bachelor of Science in Psychology'>Bachelor of Science in Psychology</option><option value='Bachelor of Science in Development Communication'>Bachelor of Science in Development Communication</option>");
                } else if (val == "COLLEGE OF BUSINESS ADMINISTRATION AND ACCOUNTANCY") {
                    $("#course").html("<option value='Bachelor of Science in Accountancy'>Bachelor of Science in Accountancy</option><option value='Bachelor of Science in Business Administration'>Bachelor of Science in Business Administration</option><option value='Bachelor of Science in Entrepreneurship'>Bachelor of Science in Entrepreneurship</option><option value='Bachelor of Science in Management Accounting'>Bachelor of Science in Management Accounting</option>");
                } else if (val == "COLLEGE OF EDUCATION") {
                    $("#course").html("<option value='Bachelor of Culture and Arts Education'>Bachelor of Culture and Arts Education</option><option value='Bachelor of Early Childhood Education'>Bachelor of Early Childhood Education</option><option value='Bachelor of Elementary Education'>Bachelor of Elementary Education</option><option value='Bachelor of Secondary Education'>Bachelor of Secondary Education</option>");
                } else if (val == "COLLEGE OF ENGINEERING") {
                    $("#course").html("<option value='Bachelor of Science in Agricultural and Biosystems Engineering'>Bachelor of Science in Agricultural and Biosystems Engineering</option><option value='Bachelor of Science in Civil Engineering'>Bachelor of Science in Civil Engineering</option><option value='Bachelor of Science in Information Technology'>Bachelor of Science in Information Technology</option>");
                } else if (val == "COLLEGE OF FISHERIES") {
                    $("#course").html("<option value='Bachelor of Science in Fisheries'>Bachelor of Science in Fisheries</option>");
                } else if (val == "COLLEGE OF HOME SCIENCE AND INDUSTRY") {
                    $("#course").html("<option value='Bachelor of Science in Fashion and Textile Technology'>Bachelor of Science in Fashion and Textile Technology</option><option value='Bachelor of Science in Hospitality Management'>Bachelor of Science in Hospitality Management</option><option value='Bachelor of Science in Tourism Management'>Bachelor of Science in Tourism Management</option><option value='Bachelor of Science in Food Technology'>Bachelor of Science in Food Technology</option>");
                } else if (val == "COLLEGE OF VETERINARY SCIENCE AND MEDICINE") {
                    $("#course").html("<option value='Doctor of Veterinary Medicine'>Doctor of Veterinary Medicine</option>");
                } else if (val == "COLLEGE OF SCIENCE") {
                    $("#course").html("<option value='Bachelor of Science in Biology'>Bachelor of Science in Biology</option><option value='Bachelor of Science in Chemistry'>Bachelor of Science in Chemistry</option><option value='Bachelor of Science in Environmental Science'>Bachelor of Science in Environmental Science</option><option value='Bachelor of Science in Mathematics'>Bachelor of Science in Mathematics</option><option value='Bachelor of Science in Statistics'>Bachelor of Science in Statistics</option><option value='Bachelor of Science in Meteorology'>Bachelor of Science in Meteorology</option>");
                } else if (val == "0") {
                    $("#course").html("<option value=''>Choose your course</option>");
                }
            });
        });
    </script>
</body>

</html>