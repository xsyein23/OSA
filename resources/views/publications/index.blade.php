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
    .content {
        padding-top: 144px;
    }

    .card-footer,
    .card-body {
        color: black;
    }

    .col {
        position: relative;
        transition: transform 0.3s ease-in-out;
        overflow: hidden;
    }

    .col img {
        transition: filter ease-in-out;
        max-width: 100%;
        height: auto;
        display: block;
    }

    .buttons {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: none;
    }

    .buttons button {
        margin-right: 10px;
    }

    .col:hover .buttons {
        display: flex;
    }


    .col:hover .card img {
        filter: blur(3px);
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

        <div class="bg-image ripple" data-mdb-ripple-color="light">
            <img src="{{asset('assets/img/banner1.1.png')}}" class="banner__img" style="height: 30vh;" />
            <a href="#!">
                <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
                    <div class="d-flex justify-content-center align-items-center h-100 text-center">
                        <h2 class="text-white mb-0">PUBLICATIONS</h2>
                    </div>
                </div>
            </a>
        </div>


        <div class="container pt-3">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('impu') }}">IMPU</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Publication Pages</li>
                </ol>
            </nav>

            <div class="row">
                <div class="osa-tag">
                    <p class="tag-info text-uppercase">Publications</p>
                    <p class="tag-sub">See all the University and College Publications from the Office of Student Affairs(OSA)</p>
                </div>
            </div>
        </div>

        <div class="container d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary shadows" data-mdb-toggle="modal" data-mdb-target="#add_publication">
                <i class="fas fa-notes-medical"></i> Add Publication Page
            </button>
        </div>

        <div class="container mt-4">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @forelse ($publications as $publication)
                <div class="col cols">
                    <a href="{{ route('publications.page', ['publication_ID' => $publication->id]) }}" class="card-link">
                        <div class="card h-100 shadows border">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="{{ asset('upload/img/' . basename($publication->image)) }}" class="card-img-top" alt="" style="height: 30vh; object-fit: cover;" />
                                <!-- <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>   -->
                            </div>
                            <div class="buttons">
                                <button type="button" data-id="{{ $publication->id }}" class="btn btn-primary editpub_Btn">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" data-id="{{ $publication->id }}" class="btn btn-danger arcper_Btn">
                                    <i class="fas fa-archive"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <h5 class="card-name mt-3 text-center">
                                    {{ $publication->title }}
                                </h5>
                            </div>
                            <div class="card-footer">
                                <p style="text-align: center;">
                                    {{ $publication->description }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @empty
                <div class="container p-2 justify-content-center d-flex">
                    <h1 class="text-warning">
                        No Data Found!
                    </h1>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="add_publication" tabindex="-1" aria-labelledby="add_publication" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{ route('publications.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-title">Add New Publication</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="myfile">Image<span class="text-danger"> *</span></label>
                            <img class="card-img-top movie_input_img" id="addimage" src="../img/Default_images.svg" alt="&nbsp" style="width: 100%; height: 30vh; object-fit: cover;">
                            <input type="file" class="form-control mt-2" id="image" name="image" accept="image/*" onchange="loadFile(event)" multiple required />
                        </div>
                        <div class="mb-3">
                            <label for="title">Publication Name<span class="text-danger"> *</span></label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Enter Title Name" required>
                        </div>
                        <label for="description">Description<span class="text-danger"> *</span></label>
                        <input class="form-control" id="description" name="description" placeholder="Enter description" required>
                    </div>
                    <div class="modal-footer pt-4">
                        <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" name="handle_submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Archive Confirmation Modal -->
    <div class="modal fade" id="archive" tabindex="-1" aria-labelledby="archive" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="POST" action="{{ route('publications.archive') }}" id="archiveForm">
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

    <!-- Edit Publication Info Modal -->
    <div class="modal fade" id="edit_publication_info" tabindex="-1" aria-labelledby="edit_publication_info" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="POST" action="{{ route('publications.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-title">Update Publication Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="pub_id" id="pub_id">
                            <img class="card-img-top movie_input_img" id="output" alt="" style="width: 100%; height: 30vh; object-fit: cover;">
                            <label for="pubImg" class="mt-2">Image</label>
                            <input type="file" class="form-control mt-2" id="pubImg" name="pubImg" accept="image/*" onchange="loadFiles(event)" />
                        </div>
                        <div class="mb-3">
                            <label for="title">Publication Name<span class="text-danger"> *</span></label>
                            <input type="text" name="titles" class="form-control" id="titles" placeholder="Enter publication Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="descriptions">Description<span class="text-danger"> *</span></label>
                            <textarea class="form-control" id="descriptions" name="descriptions" placeholder="Enter publication description" required></textarea>
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


    @include('embed.footer')


    <script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>
    <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/js/alert.js') }}"></script>

    <script>
        var loadFiles = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.setAttribute("class", "out");
        };

        var loadFile = function(event) {
            var image = document.getElementById('addimage');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.setAttribute("class", "out");
        };

        // Edit modal for publication
        $('.editpub_Btn').on('click', function(event) {
            event.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                method: 'POST',
                url: "{{ route('publications.fetch') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    pub_id: id
                },
                success: function(response) {
                    if (response.error) {
                        console.log("Error: No rows found.");
                    } else {
                        let data = response.data;
                        $('#pub_id').val(data.id);
                        $('#output').attr('src', data.image);
                        $('#titles').val(data.title);
                        $('#descriptions').val(data.description);
                    }
                }
            });
            $('#edit_publication_info').modal('show');
        });

        // Archive modal for publication
        $('.arcper_Btn').on('click', function(event) {
            event.preventDefault();
            let id = $(this).data('id');
            $('#archive_id_input').val(id);
            $('#archive').modal('show');
        });
    </script>

</body>

</html>