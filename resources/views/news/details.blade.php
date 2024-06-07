<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office of Student Affairs</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" class="icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/mdb.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/index.css') }}" />
    @include('embed.link')
</head>

<style>
    .content {
        /* Adjust the padding top to prevent content from being hidden behind the fixed navbar */
        padding-top: 144px;
        /* Assuming the navbar height is 70px */
    }

    .justify-text {
        text-align: justify;
    }

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

    .breadcrumb a {
        color: black;
    }
</style>

<body style="background-color: #fdfdfd">

    @include('embed.header')

    <div class="content">
        <div class="container pt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('news.index') }}"></i>News</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>

            <div class="row">
                <div class="osa-tag">
                    <p class="tag-info">NEWS DETAILS</p>
                    <p class="tag-sub">Latest News from OSA</p>
                </div>
            </div>
        </div>

        <div class="container p-2 mt-2">
            <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel" data-mdb-carousel-init>
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @if (!empty($imagePaths))
                        @foreach ($imagePaths as $key => $imagePath)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ asset('/' . $imagePath) }}" class="d-block w-100" alt="" />
                        </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                    @else
                    <div class="carousel-item active">
                        <img src="{{ asset('upload/announcements/' . basename($announcement->cover)) }}" class="d-block w-100" alt="" style="height: 50vh; object-fit:cover;" />
                    </div>
                    @endif
                </div>

            </div>
            <div class="card-body">
                <div class="row pt-3">
                    <div class="col justify-content-end d-flex">
                        <small><i class="fa fa-calendar"></i>
                            &nbsp
                            {{ \Carbon\Carbon::parse($announcement->date_created)->format('F j, Y') }}
                        </small>
                    </div>
                </div>
                <div class="pt-3">
                    <h5>{{ $announcement['title'] }}</h5>
                </div>
                <p class="card-text mt-5 justify-text">
                    {!! nl2br(strip_p_tags($announcement->descriptions)) !!}
                </p>
            </div>
            @auth
            @if(Auth::user()->userType == 'Admin')
            <div class="row mt-5">
                <div class="col">
                    <button class="btn btn-success shadows" data-mdb-toggle="modal" data-mdb-target="#update_announcement">
                        <i class="fas fa-pen-to-square"></i> Update
                    </button>
                    <button class="btn btn-danger shadows" data-mdb-toggle="modal" data-mdb-target="#archive">
                        <i class="fas fa-box-archive"></i> Archive
                    </button>
                </div>
            </div>
            @endif
            @endauth
        </div>

        <div class="container d-flex justify-content-center pt-3">
            <a href="{{ route('news.index') }}" class="btn btn-dark shadows">View More News</a>
        </div>
    </div>

    <!-- Archive Modal -->
    <div class="modal fade" id="archive" tabindex="-1" role="dialog" aria-labelledby="archive" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('news.archive', ['news' => $announcement->id]) }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white p-4">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <i class="fas fa-circle-exclamation text-danger justify-content-center d-flex"></i>
                        <div class="col content-modal mt-5">
                            <h4 class="justify-content-center d-flex fw-semibold pt-3">Archive Announcement</h4>
                            <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to archive this announcement?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger px-4">Archive</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Update Announcement Modal -->
    <div class="modal fade" id="update_announcement" tabindex="-1" aria-labelledby="update_announcement" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('news.update', ['news' => $announcement->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-title">Update News</h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <img class="card-img-top" id="currentCover" src="{{ asset('upload/announcements/' . basename($announcement->cover)) }}" style="width: 100%; height: 40vh; object-fit: cover;">
                            <label for="cover">Cover</label>
                            <input type="file" class="form-control mt-2" id="cover" name="cover" accept="image/*" onchange="loadFile(event)" />
                        </div>
                        <div class="mb-3">
                            <label for="myfiles">Image/s</label>
                            <input type="file" class="form-control mt-2" id="myfile" name="myfile[]" accept="image/*" multiple />
                        </div>
                        <div class="mb-3">
                            <label for="title">Announcement Title <span class="text-danger">*</span></label>
                            <input value="{{ $announcement['title'] }}" type="text" name="title" class="form-control" id="title" placeholder="Enter News Title" required>
                        </div>
                        <div class="mb-3">
                            <label for="description">Description <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="descriptions" id="mytextarea" value="{{ $announcement['descriptions'] }}" required>
                        </div>
                    </div>
                    <div class="modal-footer pt-4">
                        <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" name="handle_submit_update" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('embed.footer')

    <!-- MDB -->
    <script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
    <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        var loadFile = function(event) {
            var image = document.getElementById('currentCover');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.setAttribute("class", "out");
        };

        // tiny mce function
        tinymce.init({
            selector: "#mytextarea"
        });

        // Initialize carousel
        $(document).ready(function() {
            $('#myCarousel').carousel();

            // Listen for arrow key presses
            $(document).keydown(function(e) {
                if (e.keyCode == 37) {
                    $('#myCarousel').carousel('prev'); // Slide to the previous item on left arrow key press
                } else if (e.keyCode == 39) {
                    $('#myCarousel').carousel('next'); // Slide to the next item on right arrow key press
                }
            });
        });

        function displayCurrentCover(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('currentCover').src = e.target.result;
            }

            reader.readAsDataURL(file);
        }
    </script>

</body>

</html>