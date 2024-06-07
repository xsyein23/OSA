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
    .content {
        padding-top: 143px;
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

    #card-news {
        /* padding: 20px; */
        transition: transform 0.3s ease;
    }

    #card-news:hover {
        transform: translateY(-5px);
    }
</style>

<body style="background-color: #fdfdfd">

    @include('embed.header')

    <div class="content">

        <div class="bg-image ripple" data-mdb-ripple-color="light">
            <img src="{{asset('assets/img/banner1.1.png')}}" class="banner__img" style="height: 30vh;" />
            <a href="#!">
                <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
                    <div class="d-flex justify-content-center align-items-center h-100 text-center">
                        <h2 class="text-white mb-0">{{ $publication->title }}</h2>
                    </div>
                </div>
            </a>
        </div>

        <div class="container pt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('impu') }}">IMPU</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('publications.index') }}">Publication Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $publication->title }}</li>
                </ol>
            </nav>

            <div class="row">
                <div class="col">
                    <div class="osa-tag">
                        <p class="tag-info text-capitalize">{{ $publication->title }}</p>
                        <p class="tag-sub">See all the latest news here</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary shadows" data-mdb-toggle="modal" data-mdb-target="#add_post">
                <i class="fas fa-notes-medical"></i> Add News Post
            </button>
        </div>
        <div class="container">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach ($posts as $post)
                <div class="col">
                    <div class="card" id="card-news">
                        <div class="blog-item">
                            <div class="bg-image hover-overlay ripple">
                                <img src="{{ asset('upload/img/' . basename($post->image)) }}" class="card-img-top" alt="" style="height: 40vh; object-fit: cover;" />
                            </div>
                            <div class="blog-content">
                                <div class="card-body">
                                    <div class="col justify-content-end d-flex">
                                        <small><i class="fa fa-calendar"></i>&nbsp
                                            {{ \Carbon\Carbon::parse($post->date_created)->format('F j, Y') }}
                                        </small>
                                    </div>
                                    <a href="{{ route('publications.details', ['id' => $post->id]) }}">
                                        <h5 class="title">
                                            {{ \Illuminate\Support\Str::limit($post->title, 20) }}
                                        </h5>
                                    </a>
                                    <small>
                                        {!! \Illuminate\Support\Str::limit(strip_tags($post->descriptions), 150) !!}
                                    </small>
                                    <div class="card-footer">
                                        <div class="row">
                                            <div class="col">
                                            </div>
                                            <div class="col justify-content-end d-flex">
                                                <a href="{{ route('publications.details', ['id' => $post->id]) }}">
                                                    <small>Read more...</small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="add_post" tabindex="-1" aria-labelledby="add_post" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-title">Add Post</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Add hidden input field for own_by value -->
                        <input type="hidden" name="own_by" value="{{ $publication->id }}">
                        <!-- Rest of the form content -->
                        <div class="mb-3">
                            <label for="myfile">Image<span class="text-danger"> *</span></label>
                            <img class="card-img-top movie_input_img" id="output" src="../assets/img/Default_images.svg" alt="Card image" style="width: 100%; height: 20vh; object-fit: cover;">
                            <input type="file" class="form-control mt-2" id="myfile" name="myfile[]" accept="image/*" onchange="loadFile(event)" multiple required />
                            <!-- <input type="file" class="form-control mt-2" id="myfile" name="myfile" accept="image/*" onchange="loadFile(event)" /> -->
                        </div>
                        <div class="mb-3">
                            <label for="title">Post Title<span class="text-danger"> *</span></label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title Name" required>
                        </div>
                        <label for="description">Description<span class="text-danger"> *</span></label>
                        <textarea class="form-control" id="mytextarea" name="description"></textarea>
                    </div>
                    <div class="modal-footer pt-4">
                        <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" name="handle_submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Modal  -->
    <div class="modal fade" id="add_posst" tabindex="-1" aria-labelledby="add_post" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-title">Add Post</h1>
                            <i data-bs-dismiss="modal" aria-label="Close"></i>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="myfile">Image<span class="text-danger"> *</span></label>
                            <img class="card-img-top movie_input_img" id="output" src="../assets/img/Default_images.svg" alt="Card image" style="width: 100%; height: 20vh; object-fit: cover;">
                            <input type="file" class="form-control mt-2" id="myfile" name="myfile[]" accept="image/*" onchange="loadFile(event)" multiple required />
                            <!-- <input type="file" class="form-control mt-2" id="myfile" name="myfile" accept="image/*" onchange="loadFile(event)" /> -->
                        </div>
                        <div class="mb-3">
                            <label for="title">Post Title<span class="text-danger"> *</span></label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title Name" required>
                        </div>
                        <label for="description">Description<span class="text-danger"> *</span></label>
                        <textarea class="form-control" id="mytextarea" name="description"></textarea>
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
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
    <script>
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.setAttribute("class", "out");
        };
    </script>
    <script>
        tinymce.init({
            selector: "#mytextarea"
        });
    </script>
</body>

</html>