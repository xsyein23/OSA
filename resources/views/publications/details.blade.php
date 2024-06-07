<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office of Student Affairs</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" class="icon">
    <link rel="stylesheet" href="{{ asset('assets/css/mdb.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @include('embed.link')
</head>
<style>
    .content {
        padding-top: 150px;
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
</style>

<body style="background-color: #fdfdfd">

    @include('embed.header')

    <div class="content">
        <div class="container pt-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('welcome') }}">
                            <i class=" fas fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('impu') }}">IMPU</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('publications.index') }}">Publication Pages</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('publications.page', ['publication_ID' => $post->own_by]) }}">
                            {{ $publicationPageOwner->title }}
                        </a>
                    </li>
                    <li class=" breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>
            <div class="row">
                <div class="osa-tag">
                    <p class="tag-info">THE PUBLICATION POST DETAILS</p>
                    <p class="tag-sub">Please free to read our new publish</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div id="carouselExampleControls" class="carousel slide" data-mdb-ride="carousel" data-mdb-carousel-init>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('upload/img/' . basename($post->image)) }}" class="d-block w-100" alt="Cover Image" style="width: 100vw; height: 100vh; object-fit: cover" />
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-body">
                    <div class="row mt-3">
                        <div class="col ">
                            <h5>{{ $post->title }}</h5>
                        </div>
                        <div class="col text-muted d-flex justify-content-end">
                            <p>
                                {{ \Carbon\Carbon::parse($post->date_created)->format('F j, Y') }}
                            </p>
                        </div>
                    </div>
                    <p class="card-text  mt-5">
                        {!! nl2br(strip_p_tags($post->descriptions)) !!}
                    </p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <button class="btn btn-success shadows" data-mdb-toggle="modal" data-mdb-target="#update_publication" data-post-id="{{ $post->id }}">
                        <i class="fas fa-pen-to-square"></i>
                        Update
                    </button>
                    <!-- <button class="btn btn-success shadows" data-mdb-toggle="modal" data-mdb-target="#update_publication"><i class="fas fa-pen-to-square"></i> Update</button> -->
                    <!-- <button class="btn btn-danger shadows" data-mdb-toggle="modal" data-mdb-target="#archive"><i class="fas fa-box-archive"></i> Archive</button> -->
                    <button class="btn btn-danger shadows archive-btn" data-mdb-toggle="modal" data-mdb-target="#archive" data-post-id="{{ $post->id }}">
                        <i class="fas fa-box-archive"></i>
                        Archive
                    </button>
                </div>
            </div>
        </div>
        <div class="container d-flex justify-content-center pt-3">
            <a href="{{ route('publications.page', ['publication_ID' => $post->own_by]) }}" class="btn btn-dark shadows">View More Publication News</a>
        </div>

    </div>

    <!-- Update Modal -->
    <div class="modal fade" id="update_publications" tabindex="-1" aria-labelledby="update_publication" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="update_form" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-title">Update Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <img class="card-img-top movie_input_img" id="update_output" src="" alt="" style="width: 100%; height: 40vh; object-fit: cover;">
                            <label for="update_myfile" class="mt-2">Image<span class="text-danger"> *</span></label>
                            <input type="file" class="form-control mt-2" id="update_myfile" name="myfile" accept="image/*" onchange="loadFile(event)" />
                        </div>
                        <div class="mb-3">
                            <label for="update_title">Title<span class="text-danger"> *</span></label>
                            <input type="text" name="title" class="form-control" id="update_title" placeholder="Enter Title" required>
                        </div>
                        <div class="mb-3">
                            <label for="update_description">Description<span class="text-danger"> *</span></label>
                            <textarea class="form-control" id="mytextarea" name="description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer pt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Update Modal -->
    <div class="modal fade" id="update_publication" tabindex="-1" aria-labelledby="update_publication" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="update_form" method="POST" action="{{ route('publications.updatePostDetails', ['id' => $post->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-title">Update Record</h1>
                            <i data-bs-dismiss="modal" aria-label="Close"></i>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <img class="card-img-top movie_input_img" id="output" src="{{ asset('upload/img/' . basename($post->image)) }}" alt="Card image" style="width: 100%; height: 40vh; object-fit: cover;">
                            <label for="myfile" class="mt-2">Image<span class="text-danger"> *</span></label>
                            <input type="file" class="form-control mt-2" id="myfile" name="myfile" accept="image/*" onchange="loadFile(event)" />
                        </div>
                        <div class="mb-3">
                            <label for="title">Title<span class="text-danger"> *</span></label>
                            <input value="{{ $post->title }}" type="text" name="title" class="form-control" id="title" placeholder="Enter Name of Location" required>
                        </div>
                        <div class="mb-3">
                            <label for="description">Description<span class="text-danger"> *</span></label>
                            <textarea class="form-control" id="mytextarea" name="descriptions">{{ $post->descriptions }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer pt-4 ">
                        <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Update</button>
                        <!-- <button type="submit" name="handle_submit_update" class="btn btn-success">Update</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- archive modal -->
    <div class="modal fade" id="archive" tabindex="-1" role="dialog" aria-labelledby="archive" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('publications.archivePostDetails', ['id' => $post->id]) }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white p-4">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <i class="fas fa-circle-exclamation text-danger justify-content-center d-flex"></i>
                        <div class="col content-modal mt-5">
                            <h4 class="justify-content-center d-flex fw-semibold pt-3">Archive Post</h4>
                            <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to archive this post?</p>
                        </div>
                        <input type="hidden" name="post_id" id="post_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-mdb-dismiss="modal">
                            Cancel
                        </button>

                        <button type="submit" name="archive" class="btn btn-danger px-4">
                            Archive
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('embed.footer')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>
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

    <script>
        $(document).ready(function() {
            $('.archive-btn').click(function() {
                var postId = $(this).data('post-id');
                $('#post_id').val(postId);
            });
        });
    </script>


    <script>
        // $(document).ready(function() {
        //     $('#update_publication').on('show.bs.modal', function(event) {
        //         var button = $(event.relatedTarget);
        //         var post_id = button.data('post-id');
        //         var modal = $(this);

        //         $.ajax({
        //             url: '/impu/publications/details/' + post_id, 
        //             type: 'GET',
        //             success: function(response) {
        //                 // Populate form fields with post details
        //                 modal.find('#output').attr('src', response.image_url);
        //                 modal.find('#title').val(response.title);
        //                 modal.find('#mytextarea').val(response.descriptions);
        //             },
        //             error: function(xhr) {
        //                 // Handle error
        //                 console.log(xhr.responseText);
        //             }
        //         });
        //     });
        // });
    </script>


</body>

</html>