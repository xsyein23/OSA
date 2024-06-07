<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Office of Student Affairs</title>
  <link rel="icon" href="{{ asset('assets/img/logo.png') }}" class="icon">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  @include('embed.link')
</head>

<style>
  .sticky-top {
    position: sticky;
    top: 155px;
    font-size: 18px;
  }

  .active {
    /* background-color: lightgreen; */
    color: white;
    background: -webkit-linear-gradient(0deg, #008102, #93d12d);
    /* font-size: 18px; */
  }

  /* Style for active list item */
  li.active a {
    color: white;
    /* Set the text color to white */
  }

  /* Style for non-active list items */
  li:not(.active) a {
    color: black;
    /* Set the text color to black */
  }

  .tag-infos {
    border-left: 8px solid #FFD600;
    color: #148D08;
    padding-left: 10px;
    margin-right: 10px;
  }

  .border.border-yellow {
    border: 4px solid var(--yellow) !important;
  }

  .fw-semi {
    font-weight: 600 !important;
  }

  .h1,
  h1 {
    font-size: calc(1.375rem + 1.5vw);
  }

  a.link.white {
    color: var(--white);
  }

  a.link.white:hover {
    color: greenyellow;
  }

  /* .readbtn:hover {
    color: greenyellow;
  } */

  .truncate.line-2 {
    -webkit-line-clamp: 3;
  }

  .truncate {
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .readbtn {
    /* display: inline-block; */
    /* font-weight: 400; */
    line-height: 1.5;
    /* color: #212529; */
    /* text-align: center; */
    /* text-decoration: none; */
    /* vertical-align: middle; */
    /* cursor: pointer; */
    /* -webkit-user-select: none; */
    /* -moz-user-select: none; */
    /* user-select: none; */
    /* background-color: transparent; */
    /* border: 1px solid transparent; */
    padding: 0.375rem 0.75rem;
    /* font-size: 1rem; */
    border-radius: 2rem;
    /* transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out; */
  }

  .w-35 {
    width: 35% !important;
  }

  .image-wrapper {
    /* height: 10%; */
    /* height: 50px; */
    overflow: hidden;
    max-height: 500px;
    /* max-height: 50%; */
  }

  .card-body,
  .card-header {
    color: black;
  }

  a,
  a:hover,
  a:focus,
  a:active {
    text-decoration: none;
    color: green;
  }

  a:hover {
    color: yellowgreen;

  }

  #card-news {
    transition: transform 0.3s ease;
  }

  #card-news:hover {
    transform: translateY(-5px);
  }

  .content {
    /* Adjust the padding top to prevent content from being hidden behind the fixed navbar */
    padding-top: 140px;
    /* Assuming the navbar height is 70px */
  }
</style>

<body style="background-color: #fdfdfd">

  @include('embed.header')

  <div class="content">
    <div class="bg-image ripple" data-mdb-ripple-color="light">
      <img src="{{ asset('assets/img/banner1.1.png') }}" class="banner__img" style="height: 30vh;" />
      <a href="#!">
        <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
          <div class="d-flex justify-content-center align-items-center h-100 text-center">
            <h2 class="text-white mb-0">NEWS AND EVENTS</h2>
          </div>
        </div>
      </a>
    </div>
    <div class="container pt-4">
      <div class="row">
        <div class="col-lg-3 white-bg">
          <div class="d-none d-md-block sticky-top">
            <ul class="">
              <li class="active"><a href="{{ route('news.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;NEWS</a></li>
              <li><a href="{{ route('news.allnews') }}">&nbsp;&nbsp;&nbsp;&nbsp;ALL NEWS</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-9">
          <div class="osa-tag">
            <p class="tag-info">LATEST NEWS</p>
          </div>
          @auth
          @if(Auth::user()->userType == 'Admin')
          <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary shadows" data-mdb-toggle="modal" data-mdb-target="#add_announcement">
              <i class="fas fa-notes-medical"></i> Add news post
            </button>
          </div>
          @endif
          @endauth
          <section class="text-center text-lg-start">
            <style>
              .cascading-right {
                margin-right: -50px;
              }

              @media (max-width: 991.98px) {
                .cascading-right {
                  margin-right: 0;
                }
              }
            </style>
            <div class="py-4">
              <div class="row g-0 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                  <div class="card cascading-right" style="
                                    background: hsla(0, 0%, 100%, 0.55);
                                    backdrop-filter: blur(30px);
                                ">
                    <div class="card-body shadow-5 text-center">
                      @if($latestAnnouncement)
                      <h2 class="fw-bold">{{ $latestAnnouncement->title }}</h2>
                      <p class="text-uppercase small mb-4 justify-content-end">
                        {{ \Carbon\Carbon::parse($latestAnnouncement->date_created)->format('F j, Y') }}
                      </p>
                      <p class="truncate line-2 lh-base preserve-lines">
                        <!-- {{ Str::limit($latestAnnouncement->descriptions, 300, '...') }} -->
                        <!-- {{ Str::limit(strip_p_tags($latestAnnouncement->descriptions), 300) }} -->
                        @php
                        $description = strip_tags($latestAnnouncement->descriptions);
                        $shortDescription = mb_substr($description, 0, 300);
                        $remainingCharacters = strlen($description) - strlen($shortDescription);
                        $nextText = $remainingCharacters > 0 ? '...' : '';
                        @endphp

                        {!! nl2br(e($shortDescription)) !!}{{ $nextText }}
                      </p>
                      <a href="{{ route('news.details', $latestAnnouncement->id) }}" class="btn btn-success readbtn">Read More</a>
                    </div>
                  </div>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 d-none d-md-block">
                  <img src="{{ asset('upload/announcements/' . basename($latestAnnouncement->cover)) }}" class="w-100 rounded-4 shadow-4" alt="" />

                  @endif
                </div>
              </div>
            </div>
          </section>
          <div class="pt-5">
            <div class="row">
              <div class="osa-tag">
                <p class="tag-info">OTHER NEWS</p>
                <p class="tag-sub">Access all news from the Office of Student Affairs (OSA)</p>
              </div>
            </div>
          </div>
          <div class="pt-1">
            <div class="row">
              <div class="col justify-content-end d-flex">
                <a href="{{ route('news.allnews') }}">
                  <button type="button" class="btn btn-light fw-semibold shadows" data-mdb-ripple-color="dark">View All News <i class="fas fa-angle-right"></i></button>
                </a>
              </div>
            </div>
          </div>
          <div class="pt-4">
            <div class="row row-cols-1 row-cols-md-3 g-4">
              @forelse($announcements as $announcement)
              <div class="col">
                <div class="card" id="card-news">
                  <div class="blog-item">
                    <div class="bg-image hover-overlay ripple">
                      <img src="{{ asset('upload/announcements/' . basename($announcement->cover)) }}" class="card-img-top" alt="" style="height: 20vh; object-fit: cover;" />
                    </div>
                    <div class="blog-content">
                      <div class="card-body">
                        <div class="col justify-content-end d-flex mt-2">
                          <small><i class="fa fa-calendar"></i>&nbsp;{{ \Carbon\Carbon::parse($announcement->date_created)->format('F j, Y') }}</small>
                        </div>
                        <div class="mt-2">
                          <a href="{{ route('news.details', ['id' => $announcement->id]) }}" method="GET">
                            <b>{{ $announcement->title }}</b>
                          </a>
                          <!-- ['id' => $announcement->id]) -->
                          <!-- <form action="{{ route('news.details',  $announcement->id) }}" method="GET">
                            <b type="submit">{{ $announcement->title }}</b>
                          </form> -->
                        </div>
                        <div class="mt-2">
                          <small>
                            @php
                            $description = strip_tags($announcement->descriptions);
                            $shortDescription = mb_substr($description, 0, 150);
                            $remainingCharacters = strlen($description) - strlen($shortDescription);
                            $nextText = $remainingCharacters > 0 ? '...' : '';
                            @endphp

                            {!! nl2br(e($shortDescription)) !!}{{ $nextText }}

                          </small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @empty
              <div class="p-2 justify-content-center d-flex">
                <h1 class="text-warning">No Data Found!</h1>
              </div>
              @endforelse
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Announcement Modal -->
  <div class="modal fade" id="add_announcement" tabindex="-1" aria-labelledby="add_announcement" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('news.store') }}" method="POST" id="addAnnouncementForm" enctype="multipart/form-data">
          @csrf
          <div class="modal-header bg-success text-white p-3">
            <h5 class="modal-title">Add News</h1>
              <i data-bs-dismiss="modal" aria-label="Close"></i>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <img class="card-img-top movie_input_img" id="output" alt="" style="width: 100%; height: 30vh; object-fit: cover;">
              <label for="cover">Add cover image<span class="text-danger"> *</span></label>
              <input type="file" class="form-control mt-2" id="cover" name="cover" accept="image/*" onchange="loadFile(event)" required />
            </div>
            <div class="mb-3">
              <label for="myfile">Image/s</label>
              <input type="file" class="form-control mt-2" id="myfile" name="myfile[]" accept="image/*" multiple />
            </div>
            <div class="mb-3">
              <label for="title">News Title<span class="text-danger"> *</span></label>
              <input type="text" name="title" class="form-control" id="title" placeholder="Enter news title" required>
            </div>
            <div class="mb-3">
              <label for="description">Description<span class="text-danger"> *</span></label>
              <input type="text" class="form-control" id="mytextarea" name="description" placeholder="Enter news description">
            </div>
          </div>
          <div class="modal-footer pt-4 ">
            <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
            <button type="submit" name="handle_submit" class="btn btn-success">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @include('embed.footer')

  <!-- jQuery from CDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
  <!-- Display preview image function -->
  <script>
    // var loadFile = function(event) {
    //   var image = document.getElementById('output');
    //   image.src = URL.createObjectURL(event.target.files[0]);
    //   image.setAttribute("class", "out");
    // };
  </script>

  <!-- tiny mce function -->
  <script>
    tinymce.init({
      selector: "#mytextarea"
    });
  </script>


  <script>
    $(document).ready(function() {
      $('#addAnnouncementForm').on('submit', function(event) {
        event.preventDefault(); // Prevent default form submission

        var formData = new FormData(this);

        $.ajax({
          url: '{{ route("news.store") }}',
          method: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          success: function(response) {
            if (response.success) {
              // Close the modal
              $('#add_announcement').modal('hide');

              // Redirect to the news index page
              window.location.href = '{{ route("news.index") }}';
            } else {
              // Handle validation errors or other issues
              console.log(response.errors);
            }
          },
          error: function(xhr, status, error) {
            console.error('Error:', error);
          }
        });
      });
    });

    // Function to load the selected image preview
    function loadFile(event) {
      var output = document.getElementById('output');
      output.src = URL.createObjectURL(event.target.files[0]);
    }
  </script>


</body>

</html>