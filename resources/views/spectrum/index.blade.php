<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office of Student Affairs</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" class="icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @include ('embed.link')
</head>

<style>
    .card-footer,
    .card-body {
        color: black;
    }

    .content {
        padding-top: 120px;
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
        /* Initially hide the buttons */
    }

    .buttons button {
        margin-right: 10px;
        /* Adjust the margin between buttons as needed */
    }

    .col:hover .buttons {
        display: flex;
        /* Show the buttons on hover */
    }


    .col:hover .card img {
        filter: blur(3px);
        /* Remove blur for role 1 users on hover */
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

    @include ('embed.header')

    <div class="content">

        <div class="bg-image ripple" data-mdb-ripple-color="light">
            <img src="{{ asset('assets/img/banner1.1.png') }}" class="banner__img" style="height: 30vh;" />
            <a href="#!">
                <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
                    <div class="d-flex justify-content-center align-items-center h-100 text-center">
                        <h2 class="text-white mb-0">NEWSLETTERS</h2>
                    </div>
                </div>
            </a>
        </div>

        <div class="container pt-5">

            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('welcome') }}"><i class="fas fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('impu') }}">IMPU</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Spectrum</li>
                </ol>
            </nav>

            <div class="row">
                <div class="osa-tag">
                    <p class="tag-info text-uppercase">OSA spectrum</p>
                    <p class="tag-sub">See all the newsletters from the Office of Student Affairs (OSA)</p>
                </div>
            </div>
        </div>

        <div class="container d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary shadows" data-mdb-toggle="modal" data-mdb-target="#add_newsletter">
                <i class="fas fa-notes-medical"></i> Add Newsletter
            </button>
        </div>

        <div class="container mt-4">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @forelse ($spectrums as $spectrum)
                <div class="col">
                    <div class="card h-100 shadows">
                        <a href="{{ asset('upload/newsletter/' . basename($spectrum->pdf_file)) }}" target="_blank">
                            <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">
                                <img src="{{ asset('upload/newsletter/img/' . basename($spectrum->image)) }}" class="card-img-top" alt="" style="height: 30vh; object-fit: cover;" />
                                <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                            </div>
                            <div class="buttons">
                                <button type='button' data-id='{{ $spectrum->id }}' class='btn btn-primary editspec_Btn'>
                                    <i class='fas fa-edit'></i>
                                </button>
                                <button type='button' data-id='{{ $spectrum->id }}' class='btn btn-danger arcper_Btn'>
                                    <i class='fas fa-archive'></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $spectrum->title }}</h5>
                            </div>
                        </a>
                    </div>
                </div>
                @empty
                <div class="container p-2 justify-content-center d-flex">
                    <h1 class="text-warning">No Data Found!</h1>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="add_newsletter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{ route('upload.spectrum') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-name">Upload newsletter</h1>
                            <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img class="card-img-top" id="image" style="width: 100%; height: 30vh; object-fit: cover;">
                        <label class="form-label" for="image">Cover Photo<span class="text-danger"> *</span></label>
                        <input type="file" class="form-control mb-3" id="image" name="image" accept="image/*" onchange="loadFile(event)" required />

                        <label class="form-label" for="pdf_file">Newsletter File<span class="text-danger"> *</span></label>
                        <input type="file" class="form-control mb-3" id="pdf_file" name="pdf_file" required />

                        <label for="title">Newsletter Title<span class="text-danger"> *</span></label>
                        <input type="text" name="title" class="form-control" placeholder="Enter newsletter title" required>
                    </div>
                    <div class="modal-footer pt-4 ">
                        <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" name="handle_upload" class="btn btn-success">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Archive Confirmation Modal -->
    <div class="modal fade" id="archive" tabindex="-1" aria-labelledby="archive" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="POST" action="{{ route('spectrum.archive') }}" id="archiveForm">
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
    <div class="modal fade" id="edit_spectrum_info" tabindex="-1" aria-labelledby="edit_spectrum_info" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="POST" action="{{ route('spectrum.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-title">Update Newsletter Info</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="spec_id" id="spec_id">
                            <img class="card-img-top movie_input_img" id="output" alt="" style="width: 100%; height: 30vh; object-fit: cover;">
                            <label for="pubImg" class="mt-2">Image</label>
                            <input type="file" class="form-control mt-2" id="specImg" name="specImg" accept="image/*" onchange="loadFiles(event)" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="specFile">Newsletter File</label>
                            <input type="file" class="form-control mb-3" id="specFile" name="specFile" />
                        </div>

                        <div class="mb-3">
                            <label for="title">Newsletter Title<span class="text-danger"> *</span></label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Enter newsletter title" required>
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


    @include ('embed.footer')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script>
        var loadFiles = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.setAttribute("class", "out");
        };

        var loadFile = function(event) {
            var image = document.getElementById('image');
            image.src = URL.createObjectURL(event.target.files[0]);
            image.setAttribute("class", "out");
        };

        // Edit modal for publication
        $('.editspec_Btn').on('click', function(event) {
            event.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                method: 'POST',
                url: "{{ route('spectrum.fetch') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    spec_id: id
                },
                success: function(response) {
                    if (response.error) {
                        console.log("Error: No rows found.");
                    } else {
                        let data = response.data;
                        $('#spec_id').val(data.id);
                        $('#output').attr('src', data.image);
                        $('#title').val(data.title);
                        $('#specFile').val(data.pdf_file);
                    }
                }
            });
            $('#edit_spectrum_info').modal('show');
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