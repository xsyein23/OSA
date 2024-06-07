<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Office of Student Affairs</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" class="icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style_about.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/mdb.min.css') }}" />
    @include('embed.link')
</head>


<style>
    .rs-team.inner-style .team-item {
        overflow: hidden;
    }

    .rs-team.style1 .team-item {
        position: relative;
        overflow: hidden;
    }

    .rs-team.inner-style .team-item:hover .content-part {
        bottom: unset;
        top: 50% !important;
        transform: translate(-50%, -50%) !important;
        width: unset !important;
        height: unset !important;
        /* background: transparent; */
        border-radius: unset;
        padding-top: 0;
        background: #c0c0a5;
        border-radius: 10%;
        opacity: 0.7 !important;


    }

    .rs-team.style1 .team-item .content-part {
        width: calc(100% - 60px);
    }

    .rs-team.inner-style .team-item .content-part {
        top: unset !important;
        bottom: -205px;
        transform: translateX(-50%) !important;
        /* width: 100% !important; */
        height: 300px !important;
        background: #ffffff;
        border-radius: 10%;
        padding-top: 20px;
        opacity: 0.8 !important;
        transition: all 0.3s ease;
    }


    .rs-team.style1 .team-item .content-part .name {
        /* margin-bottom: 8px; */
        font-size: 15px;
    }

    h4 {
        display: block;
        font-weight: bold;
    }

    .rs-team.inner-style .team-item:hover .content-part .name {
        color: black !important;
        margin-top: 20px;
    }

    .rs-team.inner-style .team-item .content-part .name {
        color: #111111 !important;
        margin-bottom: 12px;
    }

    .rs-team.inner-style .team-item:hover .content-part .designation {
        color: black !important;
    }

    .rs-team.inner-style .team-item .content-part .designation {
        color: #505050 !important;
        font-size: 13px;
    }

    .rs-team.style1 .team-item .content-part .designation {
        color: #ffffff;
        margin-bottom: 20px;
        display: block;
    }

    .rs-team.style1 .team-item .content-part {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, 50%);
        text-align: center;
        z-index: 1;
        transition: all 0.3s ease;
        opacity: 0;
    }

    .rs-team.inner-style .team-item .content-part .social-links {
        display: flex;
    }

    .rs-team.style1 .team-item .content-part .social-links li {
        display: inline;
        margin-right: 35px;
        padding-top: 5px;
    }

    .rs-team.style1 .team-item .content-part .social-links li button {
        display: inline-block;
        color: #ffffff;
        padding-top: 5px;
    }

    .fa {
        display: inline-block;
        font: normal normal normal 14px/1 FontAwesome;
        font-size: inherit;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        /* color: black; */
    }

    .card-container .cols {
        position: relative;
        overflow: hidden;
    }

    .card {
        position: relative;
        transition: transform 0.3s ease-in-out;
    }

    .card img {
        transition: filter ease-in-out;
        max-width: 100%;
        height: auto;
        display: block;
    }

    .content {
        /* Adjust the padding top to prevent content from being hidden behind the fixed navbar */
        padding-top: 144px;
        /* Assuming the navbar height is 70px */
    }

    .buttons {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none;
        /* Initially hide the buttons */
    }

    .buttons button {
        margin-right: 10px;
        /* Adjust the margin between buttons as needed */
    }

    .card-container:hover .buttons {
        display: flex;
        /* Show the buttons on hover */
    }

    .cols:hover .buttons {
        display: flex;
        /* Show the buttons on hover */
    }

    /* @if (session('role') == 1)
    .card-container:hover .card img {
        filter: blur(2px);
    }

    .cols:hover .card img {
        filter: blur(2px); 
    }
    @endif */

    .fa-circle-exclamation {
        font-size: 110px;
        width: fit-content;
        margin-left: 35%;
        padding: 10px;
        margin-top: -15%;
        margin-bottom: 5%;
        background-color: #fff;
        border-radius: 50%;
        position: absolute;
    }

    .red-dot {
        color: white;
    }
</style>

<body>

    <div class="fixed-top">
        <div class="logo-header ">
            <div class="container-fluid">
                <div class="row d-flex justify-content-between">
                    <div class="logo-header-left col-xl-7 col-md-7 col-xs-7 dp-xs-flex flex-row">
                        <div class="logo mr-xs-3">
                            <img src="{{ asset('assets/img/clsu-logo.png') }}" alt="CLSU_LOGO">
                        </div>
                        <div class="logo-text m-xs-0">
                            <span class="logo-title">Office of Student Affairs</span>
                            <span class="logo-sub">Central Luzon State University</span>
                            <!-- <span class="logo-sub">Science City of Muñoz, Nueva Ecija, Philippines, 3120</span> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid navi-section">
                <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars text-white"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item me-2">
                            <a class="nav-link text-white" href="{{ route('welcome') }}" active>HOME</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link text-white" href="{{ route('about_us') }}">ABOUT US</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link text-white" href="{{ route('impu') }}">IMPU</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link text-white" href="{{ route('cdesu') }}">CDESU</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link text-white" href="{{ route('gsu') }}">GSU</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link text-white" href="{{ route('sou') }}">SOU</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="nav-link text-white" href="{{ route('sdb') }}">SDB</a>
                        </li>
                        @auth
                        @if(Auth::user()->userType == 'Admin')
                        <li class="nav-item me-2">
                            <a class="nav-link text-white" href="{{ route('archives.index') }}">ARCHIVES</a>
                        </li>
                        <li class="nav-item me-2">
                            <a type="button" class="nav-link text-white dropdown-toggle" data-mdb-toggle="dropdown" aria-expanded="false">
                                COMPLAINS &nbsp;
                                <span class="red-dot"><i class="fa-solid fa-bell" style="animation: sway 1s infinite;"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <form action="{{ route('complaints.index') }}" method="GET">
                                    <li>
                                        <button type="submit" class="dropdown-item rounded-5">RECENT COMPLAINTS</button>
                                    </li>
                                </form>
                                <form action="{{ route('complaints.previous') }}" method="GET">
                                    <li>
                                        <button type="submit" class="dropdown-item rounded-5">REPLIED COMPLAINTS</button>
                                    </li>
                                </form>
                            </ul>
                        </li>
                        @endif
                        @endauth
                    </ul>
                </div>
                <div class="d-flex align-items-center">
                    @auth
                    <li class="nav-item-out">
                        <div class="btn-group shadow-0">
                            <a type="button" class="link text-white ps-3 dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->fullname }}
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <!-- <li>
                                    <form action="{{ route('manage-profile') }}" method="GET">
                                        @csrf
                                        <button class="dropdown-item rounded-5" type="submit">Profile</button>
                                    </form>
                                </li> -->
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item rounded-5" type="submit">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @else
                    <li class="nav-item-out">
                        <div class="btn-group shadow-0">
                            <a type="button" class="link text-white ps-3" href="{{ route('login') }}">
                                Login
                            </a>
                        </div>
                    </li>
                    @endauth
                </div>
            </div>
        </nav>
    </div>

    <div class="content">

        <div class="bg-image ripple" data-mdb-ripple-color="light">
            <img src="{{ asset('assets/img/banner1.1.png') }}" class="banner__img" style="height: 30vh;" />
            <a href="#!">
                <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
                    <div class="row text-center">
                        <div class="col-12 pt-3">
                            <img src="{{ asset('assets/img/white-logo.png') }}" alt="" class="banner_logo ">
                        </div>
                        <div class="col-12 pt-2">
                            <h4 class="text-white mb-0 fw-bold">OFFICE OF STUDENT AFFAIRS</h4>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="container pt-5">
            <div class="row">
                <div class="osa-tag">
                    <p class="tag-info">OVERVIEW</p>
                    <p class="tag-sub">
                        The OSA serves as the center of information, activities, and services related to the co-curricular and extra-curricular needs of students. It also promotes the development of students’ talents, potentials, and leadership capabilities through its program thrusts of self-growth and awareness, cooperative living and learning, leadership development and enhancement, productive use of leisure, and enhanced cross-cultural adjustment.
                        <br><br>
                        The OSA program was approved in 1973 with the following philosophy as a basis: “The recognition of the essential dignity and worth of each student; the willingness to help him understand himself in every means which the university in all its functions serve as fully as possible each student as an individual striving and at the same time fulfilling the objectives of education.” This underscored the importance of OSA as a component of the whole educational program of the university. In 1976, eventually, the Student Housing section, formerly under the Guidance & Counseling Unit, became a separate unit bringing to six the total number of OSA units.
                    </p>
                </div>
            </div>
        </div>

        <div class="container pt-4">
            <div class="card mb-3 shadows border">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="{{ asset('assets/img/osa-logo.jpg') }}" alt="OSA Logo" class="img-fluid rounded-start" style="height: 40vh; object-fit: cover;" />
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-name fw-semibold">OSA MISSION</h4>
                            <p class="card-text">
                                OSA shall promote the development of the students’ talents,
                                potentials, and leadership capabilities through its program thrusts that promote
                                self-awareness, self-growth and development, self-management, cooperative
                                living and learning, leadership advancement, social responsibility, nationalism
                                and patriotism, and wise use and management of relevant information.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3 shadows border">
                <div class="row g-0">
                    <div class="col-md-8">
                        <div class="card-body">
                            <h4 class="card-name fw-semibold">OSA VISION</h4>
                            <p class="card-text">
                                OSA-CLSU as a model center for student personnel services
                                supportive of the co-curricular and extra-curricular needs of its clients for their
                                well-rounded growth and development.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <img src="{{ asset('assets/img/osa-logo.jpg') }}" alt="OSA Logo" class="img-fluid rounded-end" style="height: 40vh; object-fit: cover;" />
                    </div>
                </div>
            </div>
        </div>

        <div class="container pt-5">
            <div class="row">
                <div class="osa-tag">
                    <p class="tag-info">OSA PERSONNEL</p>
                    <p class="tag-sub">Meet all the Administrators and Staffs</p>
                </div>
            </div>
        </div>
        <div class="container d-flex justify-content-end mb-3">
            @auth
            @if(Auth::user()->userType == 'Admin')
            <button type="button" class="btn btn-primary shadows" data-mdb-toggle="modal" data-mdb-target="#add_personnel">
                <i class="fas fa-notes-medical"></i> Add Personnel
            </button>
            @endif
            @endauth
        </div>

        <div class="container mb-5">
            @foreach ($personnel as $person)
            @if ($person->position === 'Dean')
            <div id="rs-team" class="rs-team style1 inner-style orange-color">
                <div class="container">
                    <div class="row m-3 row-cols-md-4">
                        <div class="col m-auto">
                            <div class="card">
                                <div class="team-item">
                                    <img src="{{ asset($person->image) }}" alt="">
                                    <div class="content-part">
                                        <h4 class="name">{{ $person->name }}</h4>
                                        <span class="designation">{{ $person->position }}</span>
                                        @auth
                                        @if(Auth::user()->userType == 'Admin')
                                        <ul class="social-links">
                                            <li>
                                                <button type="button" data-id="{{ $person->id }}" class="btn btn-black btn-sm editper_Btn">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" data-id="{{ $person->id }}" class="btn btn-black btn-sm arcper_Btn">
                                                    <i class="fa fa-archive"></i>
                                                </button>
                                            </li>
                                        </ul>
                                        @endif
                                        @endauth
                                        <ul class="social-links">
                                            <li>
                                                <a href="{{ $person->facebook }}" class="btn btn-black btn-sm">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="mailto:{{ $person->email }}" class="btn btn-black btn-sm">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach

            <div id="rs-team" class="rs-team style1 inner-style orange-color">
                <div class="container">
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        @foreach ($personnel as $person)
                        @if ($person->position != 'Dean')
                        <div class="col">
                            <div class="card">
                                <div class="team-item">
                                    <img src="{{ asset($person->image) }}" alt="">
                                    <div class="content-part">
                                        <h4 class="name">{{ $person->name }}</h4>
                                        <span class="designation">{{ $person->position }}</span>
                                        @auth
                                        @if(Auth::user()->userType == 'Admin')
                                        <ul class="social-links">
                                            <li>
                                                <button type="button" data-id="{{ $person->id }}" class="btn btn-black btn-sm editper_Btn">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </li>
                                            <li>
                                                <button type="button" data-id="{{ $person->id }}" class="btn btn-black btn-sm arcper_Btn">
                                                    <i class="fa fa-archive"></i>
                                                </button>
                                            </li>
                                        </ul>
                                        @endif
                                        @endauth
                                        <ul class="social-links">
                                            <li>
                                                <a href="{{ $person->facebook }}" class="btn btn-black btn-sm">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="mailto:{{ $person->email }}" class="btn btn-black btn-sm">
                                                    <i class="fa fa-envelope"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="mt-5 footer-section">
        <footer class="text-center text-lg-start bg-light text-muted " style="background-image: url(assets/img/banner1.png);  background-repeat: no-repeat; background-size: cover; ">
            <section class="">
                <div class="container-fluid text-md-start pt-3 px-5">
                    <div class="row mt-3">
                        <div class="col-md-3 col-lg-4 col-xl-4 mx-auto mb-4">
                            <img src="{{ asset('assets/img/white-logo.png') }}" alt="" class="footer-logo text-center" style="height: 88px;">
                            <h4 class="text-white fw-semibold mt-2">OFFICE OF STUDENT AFFAIRS</h5>
                                <p class="text-white fw-light">Science City of Muñoz, Nueva Ecija</p>
                                <small class="text-white fw-light" style="font-size: 13px;">© Copyright 2023. Central Luzon State University. All Rights Reserved</small>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                            <h5 class="text-uppercase fw-semibold mb-4 " style="color: #cdfb13;">Contact</h5>
                            <p class="text-white"><i class="fas fa-location-dot "></i> Central Luzon State University, Science City of Muñoz Nueva Ecija, Philippines</p>
                            <p class="text-white">
                                <i class="fas fa-envelope me-3 "></i>
                                osa@clsu.edu.ph
                            </p>
                            <p class="text-white"><i class="fas fa-phone me-3 "></i> (044) 940 7030</p>
                            <h5 class="text-uppercase fw-semibold mt-4 mb-3" style="color: #cdfb13;">
                                SOCIAL MEDIA
                            </h5>
                            <div>
                                <a href="https://www.facebook.com/officeofstudentaffairsCLSU" target="_blank" class="me-3 text-reset">
                                    <i class="fab fa-facebook-square fa-lg text-white"></i>
                                </a>
                                <a href="https://twitter.com/clsu_official?lang=en" target="_blank" class="me-3 text-reset">
                                    <i class="fab fa-twitter fa-lg text-white"></i>
                                </a>
                                <a href="" class="me-3 text-reset">
                                    <i class="fab fa-google fa-lg text-white"></i>
                                </a>
                                <a href="" class="me-3 text-reset">
                                    <i class="fab fa-instagram fa-lg text-white"></i>
                                </a>
                                <a href="" class="me-3 text-reset">
                                    <i class="fab fa-linkedin fa-lg text-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mb-4">
                            <div class="d-none d-md-block">
                                <h5 class="text-uppercase fw-semibold mt-4 mb-3" style="color: #cdfb13;">FIND US AT</h5>
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3840.371571834778!2d120.92522277588054!3d15.731470748389947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3390d79d974409ab%3A0x5d56c6943c4c0c79!2sOffice%20of%20Student%20Affairs!5e0!3m2!1sen!2sph!4v1710381673508!5m2!1sen!2sph" width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </footer>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="login_Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="justify-content-center d-flex" style="height: 50px;">
                        <img src="assets/img/logo.png" alt="login-logo" class="shadow rounded-circle">
                    </div>
                    <div class="py-2 justify-content-center d-flex">
                        <h5>CLSU Account for OSA</h5>
                    </div>
                    <div class="text-center">
                        <p>Log in with the credentials of your account to get more accurate view of Office of Student Affairs.</p>
                    </div>
                    <form method="POST">
                        <!-- Email input -->
                        <div class="form-outline mb-3 mt-4">
                            <input type="email" id="email" name="email" class="form-control" required />
                            <label class="form-label" for="email">Email address</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-2">
                            <input type="password" id="password" name="password" class="form-control" required />
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <div class="mb-4 justify-content-end d-flex">
                            <a href="forgot_pw/" class="text-muted">Forgot password?</a>
                        </div>
                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-dark btn-block shadow-0">Continue</button>
                        <div class="pt-3 text-center">
                            Don't have an account? <a href="register.php" class="text-success">Register Here</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Personnel Modal -->
    <div class="modal fade" id="add_personnel" tabindex="-1" aria-labelledby="add_personnel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{ route('personnel.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-name">Add New Personnel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <img class="card-img-top movie_input_img" id="addimage" src="{{ asset('img/Default_images.svg') }}" alt="&nbsp" style="width: 100%; height: 30vh; object-fit: cover;">
                            <label for="myfile">Image<span class="text-danger"> *</span></label>
                            <input type="file" class="form-control mt-2" id="myfile" name="myfile" accept="image/*" onchange="loadFile(event)" required />
                        </div>
                        <div class="mb-3">
                            <label for="name">Name<span class="text-danger"> *</span></label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name of Personnel" required>
                        </div>
                        <div class="mb-3">
                            <label for="position">Position<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" name="position" placeholder="Enter Position of Personnel" required>
                        </div>
                        <div class="mb-3">
                            <label for="facebook">Facebook Link</label>
                            <input class="form-control" type="text" name="facebook" placeholder="e.g. https://www.facebook.com/facebook.57/">
                        </div>
                        <div class="mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="e.g. email@clsu2.edu.ph">
                        </div>
                    </div>
                    <div class="modal-footer pt-4 ">
                        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Archive Confirmation Modal -->
    <div class="modal fade" id="archive" tabindex="-1" aria-labelledby="archive" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="POST" action="{{ route('personnel.archive') }}" id="archiveForm">
                    @csrf
                    <div class="modal-header bg-danger text-white p-4">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <i class="fas fa-circle-exclamation text-danger justify-content-center d-flex"></i>
                        <div class="col content-modal mt-5">
                            <h4 class="justify-content-center d-flex fw-semibold pt-3">Archive Record Confirmation</h4>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="archive_id_input" name="archive_id_input" required>
                            </div>
                            <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to archive this record?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Archive</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Personnel Info Modal -->
    <div class="modal fade" id="edit_personnel_info" tabindex="-1" aria-labelledby="edit_personnel_info" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="POST" action="{{ route('personnel.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-title">Update Personnel Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="per_id" id="per_id">
                            <img class="card-img-top movie_input_img" id="output" alt="" src="{{ asset('upload/personnel') }}" style="width: 100%; height: 30vh; object-fit: cover;">
                            <label for="perImg" class="mt-2">Image</label>
                            <input type="file" class="form-control mt-2" id="perImg" name="perImg" accept="image/*" onchange="loadFiles(event)" />
                        </div>
                        <div class="mb-3">
                            <label for="name">Name<span class="text-danger"> *</span></label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Personnel Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="positions">Position<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" id="positions" name="positions" placeholder="Enter Position of Personnel" required>
                        </div>
                        <div class="mb-3">
                            <label for="facebooks">Facebook Link</label>
                            <input class="form-control" type="text" id="facebooks" name="facebooks" placeholder="e.g. https://www.facebook.com/facebook.57/">
                        </div>
                        <div class="mb-3">
                            <label for="emails">Email</label>
                            <input type="email" class="form-control" id="emails" name="emails" placeholder="e.g. email@clsu2.edu.ph">
                        </div>
                    </div>
                    <div class="modal-footer pt-4">
                        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Edit Personnel Info Modal -->
    <div class="modal fade" id="edit_personnel_infos" tabindex="-1" aria-labelledby="edit_personnel_infos" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="POST" id="updateForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="update_id_input" id="update_id_input">
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-title">Update Personnel Info</h5>
                        <i data-bs-dismiss="modal" aria-label="Close"></i>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="per_id" id="per_id">
                            <img class="card-img-top movie_input_img" id="output" alt="" src="{{ asset('upload/personnel') }}" style="width: 100%; height: 30vh; object-fit: cover;">
                            <label for="perImg" class="mt-2">Image</label>
                            <input type="file" class="form-control mt-2" id="perImg" name="perImg" accept="image/*" onchange="loadFiles(event)" />
                        </div>
                        <div class="mb-3">
                            <label for="name">Name<span class="text-danger"> *</span></label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Enter Personnel Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="positions">Position<span class="text-danger"> *</span></label>
                            <input type="text" class="form-control" id="positions" name="positions" placeholder="Enter Position of Personnel" required>
                        </div>
                        <div class="mb-3">
                            <label for="facebooks">Facebook Link</label>
                            <input class="form-control" type="text" id="facebooks" name="facebooks" placeholder="e.g. https://www.facebook.com/facebook.57/">
                        </div>
                        <div class="mb-3">
                            <label for="emails">Email</label>
                            <input type="email" class="form-control" id="emails" name="emails" placeholder="e.g. email@clsu2.edu.ph">
                        </div>
                    </div>
                    <div class="modal-footer pt-4 ">
                        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>
    <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/js/alert.js') }}"></script>

    <script>
        var loadFile = function(event) {
            var image = document.getElementById('addimage');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.setAttribute("class", "out");
        };

        var loadFiles = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.setAttribute("class", "out");
        };

        // Edit modal for publication
        $('.editper_Btn').on('click', function(event) {
            event.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                method: 'POST',
                url: "{{ route('personnel.fetch') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    per_id: id
                },
                success: function(response) {
                    if (response.error) {
                        console.log("Error: No rows found.");
                    } else {
                        let data = response.data;
                        $('#per_id').val(data.id);
                        $('#output').attr('src', data.image);
                        $('#name').val(data.name);
                        $('#positions').val(data.position);
                        $('#facebooks').val(data.facebook);
                        $('#emails').val(data.email);
                    }
                }
            });
            $('#edit_personnel_info').modal('show');
        });

        // Archive modal for personnel
        $('.arcper_Btn').on('click', function(event) {
            event.preventDefault();
            let id = $(this).data('id');
            $('#archive_id_input').val(id);
            $('#archive').modal('show');
        });
    </script>


</body>

</html>