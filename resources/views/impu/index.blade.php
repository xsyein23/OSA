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
  @include('embed.link')
</head>
<style>
  a,
  a:hover,
  a:focus,
  a:active {
    text-decoration: none;
    color: inherit;
  }

  .content {
    /* Adjust the padding top to prevent content from being hidden behind the fixed navbar */
    padding-top: 144px;
    /* Assuming the navbar height is 70px */
  }

  .view-pdf-button .btn {
    margin-top: -30vh;
    position: absolute;
    font-weight: 600;
  }

  .card-handbook:hover {
    .btn {
      display: block;
    }

  }
</style>

<body style="background-color: #fdfdfd">

  @include('embed.header')

  <div class="content">
    <!-- banner -->
    <div class="bg-image ripple" data-mdb-ripple-color="light">
      <img src="{{ asset('assets/img/banner1.1.png') }}" class="banner__img" style="height: 30vh;" />
      <a href="#!">
        <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
          <div class="d-flex justify-content-center align-items-center h-100 text-center">
            <h2 class="text-white mb-0">INFORMATION MANAGEMENT AND PUBLICATION UNIT</h2>
          </div>
        </div>
      </a>
    </div>

    <div class="container mt-5">
      <div class="osa-tag">
        <p class="tag-info">OVERVIEW</p>
        </a>
        <p class="tag-sub ">
          This unit is designed to assist in the best practice of student affairs and
          services in the university through the aid of research, publication and
          information management. The IMPU shall be responsible for the collection,
          organization, and control over the planning, processing, evaluating and
          reporting of relevant information in order to meet client objectives and to
          enable efficient and effective delivery of services.
        </p>
      </div>
    </div>

    <!-- publication -->
    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">PUBLICATIONS</p>
          <p class="tag-sub">See all the univesity and college publications and student handbook from the Office of Student Affairs(OSA)</p>
        </div>
      </div>
    </div>

    <!-- handbook -->
    <div class="container mt-3">
      <div class="row">
        <div class="col-sm-6">
          @if ($handbook)
          @auth
          @if(Auth::user()->userType == 'Student')
          <div class="card shadows card-handbook">
            <img src="{{ asset($handbook->cover) }}" class="img-fluid hover-shadow" style="height: 60vh; object-fit: cover;" />
            <div class="d-flex justify-content-center view-pdf-button">
              <a href="{{ asset($handbook->file_name) }}" target="_blank" class="btn btn-light shadows px-5">
                <i class="fas fa-eye"></i> View
              </a>
            </div>
          </div>
          @endif
          @endauth
          @endif
          @guest
          <div class="card shadows card-handbook">
            <img src="{{ asset($handbook->cover) }}" class="img-fluid hover-shadow" style="height: 60vh; object-fit: cover;" />
          </div>
          <h6>Please <a class="text-primary" href="{{ route('login') }}" style="cursor: pointer;">login</a> to view and download the student handbook.</h6>
          @endguest


          @auth
          @if(Auth::user()->userType == 'Admin')
          <button type="button" class="btn btn-primary shadows" data-mdb-toggle="modal" data-mdb-target="#upload">
            <i class="fas fa-cloud-arrow-up"></i> Upload Handbook
          </button>
          @endif

          @if(Auth::user()->userType == 'Student')
          <a href="{{ asset($handbook->file_name) }}" download class="btn btn-danger">Download</a>
          @endif
          @endauth
        </div>
      </div>
    </div>



    <!-- publications -->
    <div class="container">
      <div class="col justify-content-end d-flex p-3">
        <a href="{{ route('publications.index') }}">
          <button type="button" class="btn fw-semibold shadows" data-mdb-ripple-color="dark">View All Publication Pages <i class="fas fa-angle-right"></i></button>
        </a>
      </div>
    </div>

    <div class="container mt-4">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse ($publications as $publication)
        <div class="col">
          <a href="{{ route('publications.page', ['publication_ID' => $publication->id]) }}" class="card-link">
            <div class="card h-100 shadows border">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="{{ asset('upload/img/' . basename($publication->image)) }}" class="card-img-top" alt="" style="height: 40vh; object-fit: cover;" />
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
              <div class="card-body">
                <h5 class="card-title">{{ $publication->title }}</h5>
                <p class="card-text" align="justify">{{ $publication->description }}</p>
              </div>
            </div>
          </a>
        </div>
        @empty
        <div class="container p-2 justify-content-center d-flex">
          <h1 class="text-warning text-uppercase">No Data Found!</h1>
        </div>
        @endforelse
      </div>
    </div>


    <!-- OSA Spectrum -->
    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">SPECTRUM</p>
          <p class="tag-sub">See all the newsletters from the Office of Student Affairs(OSA)</p>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="col justify-content-end d-flex p-3">
        <a href="{{ route('spectrum.index') }}">
          <button type="button" class="btn fw-semibold shadows" data-mdb-ripple-color="dark">View All Newsletters<i class="fas fa-angle-right"></i></button>
        </a>
      </div>
    </div>

    <div class="container mt-4">
      <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse ($spectrums as $spectrum)
        <div class="col">
          <div class="card h-100 shadows">
            <a href="{{ asset('upload/newsletter/' . basename($spectrum->pdf_file)) }}" target="_blank">
              <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                <img src="{{ asset('upload/newsletter/img/' . basename($spectrum->image)) }}" class="card-img-top" alt="" style="height: 30vh; object-fit: cover;" />
                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
              </div>
              <div class="card-body">
                <h5 class="card-title">{{ $spectrum->title }}</h5>
              </div>
            </a>
          </div>
        </div>
        @empty
        <div class="container p-2 justify-content-center d-flex">
          <h1 class="text-warning text-uppercase">No Data Found!</h1>
        </div>
        @endforelse
      </div>
    </div>

    <!-- Research and evaluation -->
    <div class="container pt-5">
      <div class="row">
        <div class="osa-tag">
          <p class="tag-info">RESEARCH AND EVALUATION</p>
          <p class="tag-sub">See all the research and evaluation from the Office of Student Affairs(OSA)</p>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="col justify-content-end d-flex p-3">
        @auth
        @if(Auth::user()->userType == 'Student')
        <a href="{{ route('evaluations.index') }}">
          <button type="button" class="btn fw-semibold shadows" data-mdb-ripple-color="dark">View All Research & Evaluation <i class="fas fa-angle-right"></i></button>
        </a>
        @elseif(Auth::user()->userType == 'Admin')
        <a href="{{ route('evaluations.admin.index') }}">
          <button type="button" class="btn fw-semibold shadows" data-mdb-ripple-color="dark">View All Research & Evaluation <i class="fas fa-angle-right"></i></button>
        </a>
        @endif
        @endauth
        @guest
        <a href="{{ route('evaluations.index') }}">
          <button type="button" class="btn fw-semibold shadows" data-mdb-ripple-color="dark">View All Research & Evaluation <i class="fas fa-angle-right"></i></button>
        </a>
        @endguest
      </div>
    </div>

    <div class="container mt-4">

      @auth
      @if(Auth::user()->userType == 'Student')
      <div class="row">
        @forelse ($evaluations as $evaluation)
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Academic Year: {{ $evaluation->year }}, {{ $evaluation->semester }} semester</h6>
            </div>
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="h5 font-weight-bold text-gray text-uppercase mb-3">
                    {{ $evaluation->title }}
                  </div>
                  @php
                  $userID = Auth::id();
                  $num_responses = DB::table('responses')
                  ->where('userID', $userID)
                  ->where('evaluation_id', $evaluation->id)
                  ->count();

                  $num_criteria = DB::table('criteria_list')
                  ->where('evaluation_id', $evaluation->id)
                  ->count();
                  @endphp

                  @if ($num_responses > 0)
                  <div class="h6 mb-0 font-weight-bold text-gray-800">
                    Status:
                    <span class="badge badge-success">COMPLETED</span>
                  </div>
                </div>
                <div class="col-auto">
                  <span class="fas fa-check fa-3x"></span>
                </div>
                @else
                <div class="h6 mb-0 font-weight-bold text-gray-800">
                  Status:
                  <span class="badge badge-warning">NOT STARTED</span>
                </div>
              </div>

              <div class="col-auto">
                <div class="col-auto">
                  <form action="{{ route('evaluations.student.index') }}" method="POST">
                    @csrf
                    <input type="hidden" name="eval_id" value="{{ $evaluation->id }}">
                    <button class="btn badge badge-primary">EVALUATE NOW</button>
                  </form>
                </div>
              </div>
              @endif
            </div>
          </div>

        </div>
      </div>
      @empty
      <div class="container p-2 justify-content-center d-flex">
        <h1 class="text-warning text-uppercase">No Data Found!</h1>
      </div>
      @endforelse
      @endif
      @endauth

      @auth
      @if(Auth::user()->userType == 'Admin')
      <div class="row">
        @forelse ($evaluations as $evaluation)
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Academic Year: {{ $evaluation->year }}, {{ $evaluation->semester }} semester</h6>
            </div>
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="h5 font-weight-bold text-gray text-uppercase mb-3">
                    {{ $evaluation->title }}
                  </div>
                  <div class="h6 mb-0 font-weight-bold text-gray-800">
                    Status:
                    <span class="badge badge-success font-weight-bold">{{ $evaluation->status }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="container p-2 justify-content-center d-flex">
          <h1 class="text-warning text-uppercase">No Data Found!</h1>
        </div>
        @endforelse
      </div>
      @endif
      @endauth


      @guest
      <div class="row">
        @forelse ($evaluations as $evaluation)
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
              <h6 class="m-0 font-weight-bold text-primary">Academic Year: {{ $evaluation->year }}, {{ $evaluation->semester }} semester</h6>
            </div>
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="h5 font-weight-bold text-gray text-uppercase mb-3">
                    {{ $evaluation->title }}
                  </div>
                  <div class="h6 mb-0 font-weight-bold text-gray-800">
                    Status:
                    <span class="badge badge-success font-weight-bold">-----</span>
                  </div>
                </div>
                <div class="col-auto">
                  <a type="button" href=" {{ route('login') }}"><span class="badge badge-primary">EVALUATE NOW</span></a>
                </div>
              </div>
            </div>
          </div>
        </div>
        @empty
        <div class="container p-2 justify-content-center d-flex">
          <h1 class="text-warning text-uppercase">No Data Found!</h1>
        </div>
        @endforelse
      </div>
      @endguest

    </div>

  </div>
  </div>

  <!--Upload Handbook Modal -->
  <div class="modal fade" id="upload" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <form action="{{ route('upload.handbook') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-header bg-success text-white p-3">
            <h5 class="modal-name">Upload Student Handbook</h1>
              <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <img class="card-img-top" id="cover" style="width: 100%; height: 30vh; object-fit: cover;">
            <label class="form-label" for="cover">Cover Photo<span class="text-danger"> *</span></label>
            <input type="file" class="form-control" id="cover" name="cover" accept="image/*" onchange="loadFile(event)" required />

            <label class="form-label" for="handbook">Handbook PDF<span class="text-danger"> *</span></label>
            <input type="file" class="form-control mb-3" id="file_name" name="file_name" required />

          </div>

          <div class="modal-footer pt-4 ">
            <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
            <button type="submit" name="handle_upload" class="btn btn-success">Upload</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Login-->
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
            <p>Log in with the credentials of your account to get more accurate view of office of student affairs.</p>
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
              <a href="../forgot_pw/" class="text-muted">Forgot password?</a>
            </div>
            <!-- Submit button -->
            <button type="submit" name="submit" class="btn btn-dark btn-block shadow-0">Continue</button>
            <div class="pt-3 text-center">
              Don't have an account? <a href="../register.php" class="text-success">Register Here</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  @include('embed.footer')

  <!-- MDB -->
  <script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>

  <script>
    var loadFile = function(event) {
      var image = document.getElementById('cover');
      image.src = URL.createObjectURL(event.target.files[0]);
      image.setAttribute("class", "out");
    };
  </script>

</body>

</html>