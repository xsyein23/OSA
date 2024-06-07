<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Office of Student Affairs</title>
  <link rel="icon" href="{{ asset('assets/img/logo.png') }}" class="icon">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('assets/css/mdb.min.css') }}" />
</head>

<style>
  .content {
    /* Adjust the padding top to prevent content from being hidden behind the fixed navbar */
    padding-top: 70px;
    /* Assuming the navbar height is 70px */
  }

  a,
  a:hover,
  a:focus,
  a:active {
    text-decoration: none;
    color: inherit;
  }

  a:hover {
    color: green;

  }

  .carousel-caption {
    text-shadow: -1px 1px 2px #000,
      1px 1px 6px #000,
      1px -1px 0 #000,
      -1px -1px 0 #000;
  }

  .carousel-inner {
    position: relative;
  }

  .carousel-item::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    background: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.3));
    /* background: rgb(215, 214, 236);
    background: linear-gradient(90deg, rgba(215, 214, 236, 0.03405112044817926) 0%, rgba(0, 255, 81, 0.700717787114846) 100%, rgba(0, 255, 81, 0.03125) 100%); */
    /* Adjust the gradient colors and transparency as needed */
    z-index: 1;
  }

  .carousel-caption {
    z-index: 2;
    /* Ensure the caption is above the overlay */
    color: #fff;
    /* Set the text color for better readability on the overlay */
  }

  .mb-45 {
    margin-bottom: 45px;
  }

  .sec-title3 .title.black-color {
    color: #101010;
  }

  .sec-title3 .sub-title {
    font-size: 16px;
    line-height: 28px;
    font-weight: 500;
    color: green;
    text-transform: uppercase;
    margin-bottom: 10px;
  }

  .row {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
  }

  .rs-features .features-wrap:hover {
    transform: translateY(-10px);
  }

  .rs-features .features-wrap {
    border-radius: 5px 5px 5px 5px;
    background: #171f32;
    padding: 25px 40px 25px;
    display: flex;
    align-items: center;
    position: relative;
    transition: all 0.3s ease;
  }

  .rs-features .icon-part img {
    width: 50px;
    margin: 0 35px 8px 0;
  }

  .features-wrap {
    display: flex;
    /* Use flexbox for layout */
    align-items: center;
    /* Align items vertically */
  }

  .icon-part {
    margin-right: 40px;
    margin-left: 30px;
    /* Add some margin to the right of the icon */
  }

  .icon-part img {
    width: 100%;
    /* Set the width of the icon image */
    height: auto;
    /* Maintain aspect ratio */
  }

  h4 {
    display: block;
    margin-block-start: 1.33em;
    margin-block-end: 1.33em;
    margin-inline-start: 0px;
    margin-inline-end: 0px;
    font-weight: bold;
  }

  .rs-features .features-wrap .content-part .dese {
    font-size: 16px;
    font-weight: 400;
    color: #ffffff;
    margin: 0;
  }

  /* .cards {
    background-color: black;
  } */

  .cards {
    /* background-image: linear-gradient(#827e7e, #f0f0f0); */
    background-image: linear-gradient(90deg, rgba(0, 129, 2, 1) 0%, rgba(114, 177, 9, 1) 100%);
    /* background-image: url('assets/img/carousel/8.jpg'); */
    /* Set the background image */
    background-size: cover;
    /* Cover the entire element with the background image */
    background-position: center;
    /* Center the background image */
    padding: 20px;
    /* Add some padding to the card */
    border-radius: 10px;
    /* Add some border radius for rounded corners */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    /* Add a box shadow for a subtle effect */
    transition: transform 0.3s ease;
    color: white;
    /* border-radius: 10px; */
  }

  .cards:hover {
    transform: translateY(-5px);
    /* Move the card upward by 5px on hover */
  }

  #card-news {
    /* padding: 20px; */
    transition: transform 0.3s ease;
  }

  #card-news:hover {
    transform: translateY(-5px);
  }

  .units {
    padding-bottom: 50px;
  }

  .event-bg {
    background: #f9f8f8;
    padding-bottom: 50px;
  }

  .content {
    /* Adjust the padding top to prevent content from being hidden behind the fixed navbar */
    padding-top: 140px;
    /* Assuming the navbar height is 70px */
  }

  .error_message {
    display: none;
  }

  .load {
    display: none;
  }

  .showbtn {
    display: block;
  }

  .dot {
    height: 8px;
    width: 8px;
    background-color: red;
    border-radius: 50%;
    display: inline-block;
    margin-left: 5px;
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
                <!-- <form action="{{ route('complaints.index') }}" method="GET">
                  <li>
                    <button type="submit" class="dropdown-item rounded-5">RECENT COMPLAINTS</button>
                  </li>
                </form> -->
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
                <li>
                  <form action="{{ route('manage-profile') }}" method="GET">
                    @csrf
                    <button class="dropdown-item rounded-5" type="submit">Profile</button>
                  </form>
                </li>
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
    <div class="carousel-section">
      <!-- Carousel wrapper -->
      <div id="carouselBasicExample" class="carousel slide" data-mdb-ride="carousel" data-mdb-carousel-init>
        <!-- Indicators -->
        <div class="carousel-indicators">
          <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="2" aria-label="Slide 3"></button>
          <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="3" aria-current="true" aria-label="Slide 4"></button>
          <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="4" aria-current="true" aria-label="Slide 5"></button>
          <button type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide-to="5" aria-current="true" aria-label="Slide 6"></button>
        </div>

        <!-- Inner -->
        <div class="carousel-inner">
          <!-- Single item -->
          <div class="carousel-item active">
            <img src="assets/img/carousel/1.jpg" class="d-block w-100" alt="OSA SPECTRUM" />
            <div class="carousel-caption d-none d-md-block">
              <h2>OSA SPECTRUM</h2>
              <p>The IMPU instigates the publication of the OSA Spectrum, OSA’s official newspaper, featuring the services, programs and activities offered and provided by the OSA for the students. The OSA Spectrum gets published biannually. There is an OSA Editorial Staff who regularly contributes articles for the OSA Spectrum and members undergo training on news and feature writing to update their writing skills.
              </p>
            </div>
          </div>

          <!-- Single item -->
          <div class="carousel-item">
            <img src="assets/img/carousel/2.jpg" class="d-block w-100" alt="Student Leaders in an International and National Arena" />
            <div class="carousel-caption d-none d-md-block">
              <h2>Student Leaders in an International and National Arena</h2>
              <p>The Office of Student Affairs through the Student Organizations Unit sends student delegates to local, regional, national and even international conferences, trainings and workshops to enhance their leadership abilities. Interested students are selected through interviews and on the basis of their performance as student leaders.</p>
              </p>
            </div>
          </div>

          <!-- Single item -->
          <div class="carousel-item">
            <img src="assets/img/carousel/4.jpg" class="d-block w-100" alt="Transform! Young Leaders’ Convention" />
            <div class="carousel-caption d-none d-md-block">
              <h2>Transform! Young Leaders’ Convention</h2>
              <p>Empowering the Filipino youth leadership and participation in local and national communities, 18 delegates from the different student formations represented Central Luzon State University (CLSU) in the 10th Philippines I Transform! Young Leaders’ Convention (PITYLC) held at Teachers’ Camp, Baguio City last August 17 to 22, 2023. Anchored from its theme: “A Decade of Action: Leading Amid COVID and the Better Normal,” the convention organized by Youthlead Philippines focused on the incorporation of Sustainable Development Goals (SDG) in the service of young leaders.
              </p>
            </div>
          </div>

          <!-- Single item -->
          <div class="carousel-item">
            <img src="assets/img/carousel/3.jpg" class="d-block w-100" alt="PGTA, CDESU Programs" />
            <div class="carousel-caption d-none d-md-block">
              <h2>PGTA, CDESU Programs</h2>
              <p>To prepare students as part of the workforce of the country, the Career Development and Employment Services Unit (CDESU) facilitates a four-part Career Development Seminar at the CLSU Auditorium, November 9 and 15, 2023. The seminar is designed to cater the career and employment needs of CLSU students and graduates to make them more globally competitive and productive. Moreover, The Office of Student Affairs (OSA) organized the Parents, Guardians, and Teachers’ Association (PGTA) General Assembly at the CLSU Auditorium on August 12, 2023.
                PGTA reports on budget allocation, accomplishments, and projects including the renovation of OSA Tambayan were delivered by Mrs. Jovita Fajardo, PGTA President, and Asst. Prof. Alexis Ramirez, PGTA Auditor.
              </p>
            </div>
          </div>

          <!-- Single item -->
          <div class="carousel-item">
            <img src="assets/img/carousel/5.jpg" class="d-block w-100" alt="RACE Against Suicide" />
            <div class="carousel-caption d-none d-md-block">
              <h2>RACE Against Suicide</h2>
              <p>RACE Against Suicide is a program under the Guidance Service Unit that aims to equip the teachers with the knowledge, skills and attitude that they need to properly respond to our students’ mental health concerns, debunk myths about suicide, and empower them to be an effective ‘gatekeeper’ through appropriate identification, management and referral of learners-at-risk.</p>
              </p>
            </div>
          </div>

          <!-- Single item -->
          <div class="carousel-item">
            <img src="assets/img/carousel/6.jpg" class="d-block w-100" alt="Mental Health Awareness Seminar" />
            <div class="carousel-caption d-none d-md-block">
              <h2>Mental Health Awareness Seminar</h2>
              <p>In celebration of Mental Health Awareness Month, Central Luzon State University (CLSU) through the Guidance Services Unit of the Office of Student Affairs spearheads a Seminar on Mental Health Awareness with the theme “Mental Health is a Universal Human Right,” at CLSU Auditorium, October 26. Dr. Brian Limson of the Philippine Normal University serves as Resource Speaker which covers topics such as Understanding Stress, Self-Care and how people’s physical routine affects the mental health of students and faculty. Around 2200 students from different colleges of the university attended the lecture.
              </p>
            </div>
          </div>
        </div>
        <!-- Inner -->

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#carouselBasicExample" data-mdb-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <!-- Carousel wrapper -->
    </div>
    <div class="units">
      <div class="container pt-5 ">
        <div class="sec-title3 text-center mb-45">
          <div class="sub-title">Get to Know</div>
          <h2 class="title black-color">Units of Office of Student Affairs </h2>
        </div>

        <div class="row row-cols-1 row-cols-md-2 g-4">
          <div class="col">
            <a href="impu/">
              <div class="cards">
                <div class="features-wrap">
                  <div class="icon-part me-3">
                    <!-- <img src="https://cen.clsu2.edu.ph/source/images/features/icon/3.png"> -->
                  </div>
                  <div class="content-part">
                    <h4 class="title">
                      <span class="watermark">INFORMATION MANAGEMENT AND PUBLICATION UNIT</span>
                    </h4>
                    <!-- <p class="dese">OSA</p> -->
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col">
            <a href="cdesu/">
              <div class="cards">
                <div class="features-wrap">
                  <div class="icon-part me-3">
                    <!-- <img src="https://cen.clsu2.edu.ph/source/images/features/icon/3.png"> -->
                  </div>
                  <div class="content-part">
                    <h4 class="title">
                      <span class="watermark">CAREER DEVELOPMENT AND EMPLOYMENT SERVICES UNIT</span>
                    </h4>
                    <!-- <p class="dese">OSA</p> -->
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
        <div class="row row-cols-1 row-cols-md-2 g-4 pt-4">
          <div class="col">
            <a href="gsu/">
              <div class="cards">
                <div class="features-wrap">
                  <div class="icon-part me-3">
                    <!-- <img src="https://cen.clsu2.edu.ph/source/images/features/icon/3.png"> -->
                  </div>
                  <div class="content-part">
                    <h4 class="title">
                      <span class="watermark">GUIDANCE SERVICES UNIT</span>
                    </h4>
                    <!-- <p class="dese">OSA</p> -->
                  </div>
                </div>
              </div>
            </a>
          </div>
          <div class="col">
            <a href="sou/">
              <div class="cards">
                <div class="features-wrap">
                  <div class="icon-part me-3">
                    <!-- <img src="https://cen.clsu2.edu.ph/source/images/features/icon/3.png"> -->
                  </div>
                  <div class="content-part">
                    <h4 class="title">
                      <span class="watermark">STUDENT ORGANIZATION UNIT</span>
                    </h4>
                    <!-- <p class="dese">OSA</p> -->
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="event-bg">
      <div class="container pt-5">
        <div class="sec-title3 text-center mb-45">
          <div class="sub-title">News Update</div>
          <h2 class="title black-color">Latest News & Events</h2>
        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
          @forelse($announcements as $announcement)
          <div class="col">
            <div class="card" id="card-news">
              <div class="blog-item">
                <div class="bg-image hover-overlay ripple">
                  <img src="{{ asset('upload/announcements/' . basename($announcement->cover)) }}" class="card-img-top" alt="" style="height: 40vh; object-fit: cover;" />
                </div>
                <div class="blog-content">
                  <div class="card-body">
                    <div class="row">
                      <div class="col justify-content-end d-flex mt-2">
                        <small><i class="fa fa-calendar"></i>&nbsp
                          {{ \Carbon\Carbon::parse($announcement->date_created)->format('F j, Y') }}
                        </small>
                      </div>
                    </div>
                    <div>
                      <a href="{{ route('news.details', $announcement->id) }}">
                        <p class="title"><b>{{ $announcement->title }}</b></p>
                      </a>
                      <!-- <form action="{{ route('news.details', $announcement->id) }}" method="GET">
                        <p class="title" type="submit"><b>{{ $announcement->title }}</b></p>
                      </form> -->
                    </div>
                    <small>
                      <!-- {{ Str::limit(strip_p_tags($announcement->descriptions), 100) }} -->
                      @php
                      $description = strip_tags($announcement->descriptions);
                      $shortDescription = mb_substr($description, 0, 150);
                      $remainingCharacters = strlen($description) - strlen($shortDescription);
                      $nextText = $remainingCharacters > 0 ? '...' : '';
                      @endphp

                      {!! nl2br(e($shortDescription)) !!}{{ $nextText }}
                    </small>
                    <div class="card-footer">
                      <div class="row">
                        <div class="col"></div>
                        <div class="col justify-content-end d-flex">
                          <a href="{{ route('news.details', $announcement->id) }}">
                            <small>Read more...</small>
                          </a>
                          <!-- <form action="{{ route('news.details', $announcement->id) }}" method="GET">
                            <p class="title" type="submit"><b>{{ $announcement->title }}</b></p>
                          </form> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @empty
          <div class="container p-2 justify-content-center d-flex">
            <h1 class="text-warning">No Data Found!</h1>
          </div>
          @endforelse
        </div>
        <div class="container pt-5">
          <div class="text-center">
            <div class="col">
              <a href="{{ route('news.index') }}">
                <button type="button" class="btn btn-light fw-semibold shadows" data-mdb-ripple-color="dark">View More News <i class="fas fa-angle-right"></i></button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="complain">
      @auth
      @if(Auth::user()->userType == 'Student')
      <section>
        <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: white">
          <div class="container">
            <div class="row gx-lg-5 align-items-center">
              <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="my-5 display-3 fw-bold ls-tight">
                  Have a <br />
                  <span class="text-success">complain?</span>
                </h1>
                <p style="color: hsl(217, 10%, 50.8%)">
                  Send us an email so we can assist you further with your concern.
                </p>
              </div>
              <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="card">
                  <div class="card-body py-5 px-md-5">
                    <form method="POST" action="{{ route('complain.submit') }}" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" class="form-control" id="student_id" name="student_id" value="{{ Auth::user()->student_id }}" />
                      <input type="hidden" class="form-control" id="college" name="college" value="{{ Auth::user()->college }}" />
                      <div class="form-outline mb-4">
                        <input class="form-control" id="fullname" name="fullname" value="{{ Auth::user()->fullname }}" disabled />
                        <label class="form-label" for="form3Example3">Full name</label>
                      </div>
                      <div class="form-outline mb-4">
                        <input type="text" id="course" name="course" class="form-control" value="{{ Auth::user()->course }}" disabled />
                        <label class="form-label" for="form3Example4">Course</label>
                      </div>
                      <div class="form-outline mb-3">
                        <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" disabled />
                        <label class="form-label" for="form3Example3">Email address</label>
                      </div>
                      <div class="form-outline mb-4 border">
                        <textarea class="form-control rounded" id="message" rows="4" name="message" required></textarea>
                        <label class="form-label" for="message">State your concern here</label>
                      </div>
                      <div class="error_message">
                        @error('message')
                        <div class="alert alert-danger justify-content-center d-flex" role="alert">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <small class="form-label" for="myfile">Upload file (Optional)</small>
                      <div class="form-outline mb-4">
                        <input type="file" class="form-control" id="myfile" name="myfile" accept="application/pdf" />
                      </div>
                      <div class="modal-footer">
                        <button type="submit" name="submitMail" id="submitMail" class="btn btn-success btn-rounded">Send &nbsp; <i class="fas fa-paper-plane"></i></button>
                        <button class="btn btn-success btn-rounded load" type="button" disabled>
                          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                          Loading...
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      @elseif(Auth::user()->userType == 'Admin')
      <!-- none -->
      @endif
      @endauth
      @guest
      <section>
        <div class="px-4 py-5 px-md-5 text-center text-lg-start" style="background-color: white">
          <div class="container">
            <div class="row gx-lg-5 align-items-center">
              <div class="col-lg-6 mb-5 mb-lg-0">
                <h1 class="my-5 display-3 fw-bold ls-tight">
                  Have a <br />
                  <span class="text-success">complain?</span>
                </h1>
                <p style="color: hsl(217, 10%, 50.8%)">
                  Send us an email so we can assist you further with your concern.
                </p>
              </div>
              <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="card">
                  <div class="card-body py-5 px-md-5">
                    <h5><strong>How to send a complain?</strong></h5>
                    <br>
                    <h6><strong>Step 1:</strong> Login with your CLSU account.</h6>
                    <br>
                    <h6><strong>Step 2:</strong> State your concern.</h6>
                    <br>
                    <h6><strong>Step 3:</strong> Click send button.</h6>
                    <br>
                    <h6><strong>Step 4:</strong> Auto-generated email will be sent to your email address for your complaint reference number.</h6>
                    <br>
                    <h6><strong>Step 5:</strong> Wait for the official reply from the Office of Student Affairs.</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      @endguest
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
            <img src="{{ asset('assets/img/logo.png') }}" alt="login-logo" class="shadow rounded-circle">
          </div>
          <div class="py-2 justify-content-center d-flex">
            <h5>CLSU Account for OSA</h5>
          </div>
          <div class="text-center">
            <p>Log in with the credentials of your account to get more accurate view of Office of Student Affairs.</p>
          </div>
          <form method="POST" action="{{ route('login.post') }}">
            @csrf
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
              Don't have an account? <a href="{{ route('register') }}" class="text-success">Register Here</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    function spinner() {
      let message = document.getElementById('message').value;
      if (message == '') {
        document.getElementsByClassName("error_message")[0].style.display = "block";
      } else {
        document.getElementsByClassName("load")[0].style.display = "block";
        document.getElementsByClassName("showbtn")[0].style.display = "none";
        document.getElementsByClassName("error_message")[0].style.display = "none";
      }
    }
  </script>
  <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
  <script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>
  <script type="text/javascript"></script>

</body>

</html>