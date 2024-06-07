<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>OSA | Archives</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" class="icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/mdb.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
</head>

<style>
    .content {
        padding-top: 144px;
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
</style>

<body style="background-color: #fdfdfd">

    @include ('embed.header')

    <div class="content">

        <div class="bg-image ripple" data-mdb-ripple-color="light">
            <img src="{{ asset('assets/img/banner1.1.png') }}" class="banner__img" style="height: 30vh;" />
            <a href="#!">
                <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
                    <div class="d-flex justify-content-center align-items-center h-100 text-center">
                        <h2 class="text-white mb-0">ARCHIVES</h2>
                    </div>
                </div>
            </a>
        </div>
        <div class="container mt-4">
            <div class="col justify-content-end d-flex">
                <div class="col-sm-6">
                    <div class="form-group">
                        <select id="archiveType" class="form-select form-select-md">
                            <option value="announcements">Announcements</option>
                            <option value="publications">Publications</option>
                            <option value="publish">Publication Posts</option>
                            <option value="evaluations">Research & Evaluations</option>
                            <option value="spectrums">Newsletters</option>
                            <option value="personnel">Personnel</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div id="archivesContent" class="container mt-4">
            @include('archives.archive_data', ['option' => 'announcements', 'archives' => $announcements])
        </div>
    </div>

    <!-- Announcement Confirmation Modal -->
    <div class="modal fade" id="announcement_unarchive" tabindex="-1" aria-labelledby="announcement_unarchive" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="POST" action="{{ route('archives.restore') }}">
                    @csrf
                    <div class="modal-header bg-danger text-white p-4">
                        <h5 class="modal-name" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <i class="fas fa-circle-exclamation text-danger justify-content-center d-flex"></i>
                        <div class="col content-modal mt-5">
                            <h4 class="justify-content-center d-flex fw-semibold pt-3">Restore Record Confirmation</h4>
                            <div class="form-group">
                                <input type="hidden" name="type" value="announcement">
                                <input type="hidden" id="announcement_id_input" name="id" required>
                            </div>
                            <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to restore this record?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" name="announcement_unarchive_submit" class="btn btn-danger">Restore</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Publication Page Unarchive Modal -->
    <div class="modal fade" id="page_unarchive" tabindex="-1" role="dialog" aria-labelledby="page_unarchive" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('archives.restore') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white p-4">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <i class="fas fa-circle-exclamation text-danger justify-content-center d-flex"></i>
                        <div class="col content-modal mt-5">
                            <h4 class="justify-content-center d-flex fw-semibold pt-3">Restore Record Confirmation</h4>
                            <div class="form-group">
                                <input type="hidden" name="type" value="page">
                                <input type="hidden" id="page_id_input" name="id" required>
                            </div>
                            <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to restore this record?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" name="page_unarchive_submit" class="btn btn-danger">Restore</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Publish Unarchive Modal -->
    <div class="modal fade" id="publication_unarchive" tabindex="-1" role="dialog" aria-labelledby="publication_unarchive" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('archives.restore') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white p-4">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <i class="fas fa-circle-exclamation text-danger justify-content-center d-flex"></i>
                        <div class="col content-modal mt-5">
                            <h4 class="justify-content-center d-flex fw-semibold pt-3">Restore Record Confirmation</h4>
                            <div class="form-group">
                                <input type="hidden" name="type" value="publish">
                                <input type="hidden" id="publish_id_input" name="id" required>
                            </div>
                            <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to restore this record?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" name="publish_unarchive_submit" class="btn btn-danger">Restore</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Spectrum Unarchive Modal -->
    <div class="modal fade" id="spectrum_unarchive" tabindex="-1" aria-labelledby="spectrum_unarchive" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="POST" action="{{ route('archives.restore') }}">
                    @csrf
                    <div class="modal-header bg-danger text-white p-4">
                        <h5 class="modal-name" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <i class="fas fa-circle-exclamation text-danger justify-content-center d-flex"></i>
                        <div class="col content-modal mt-5">
                            <h4 class="justify-content-center d-flex fw-semibold pt-3">Restore Record Confirmation</h4>
                            <div class="form-group">
                                <input type="hidden" name="type" value="spectrum">
                                <input type="hidden" id="spectrum_id_input" name="id" required>
                            </div>
                            <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to restore this record?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" name="spectrum_unarchive_submit" class="btn btn-danger">Restore</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Research Unarchive Modal -->
    <div class="modal fade" id="evaluation_unarchive" tabindex="-1" aria-labelledby="evaluation_unarchive" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="POST" action="{{ route('archives.restore') }}">
                    @csrf
                    <div class="modal-header bg-danger text-white p-4">
                        <h5 class="modal-name" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <i class="fas fa-circle-exclamation text-danger justify-content-center d-flex"></i>
                        <div class="col content-modal mt-5">
                            <h4 class="justify-content-center d-flex fw-semibold pt-3">Restore Record Confirmation</h4>
                            <div class="form-group">
                                <input type="hidden" name="type" value="evaluation">
                                <input type="hidden" id="evaluation_id_input" name="id" required>
                            </div>
                            <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to restore this record?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" name="evaluation_unarchive_submit" class="btn btn-danger">Restore</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Personnel Unarchive Modal -->
    <div class="modal fade" id="personnel_unarchive" tabindex="-1" aria-labelledby="personnel_unarchive" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form method="POST" action="{{ route('archives.restore') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white p-4">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body ">
                        <i class="fas fa-circle-exclamation text-danger justify-content-center d-flex"></i>
                        <div class="col content-modal mt-5">
                            <h4 class="justify-content-center d-flex fw-semibold pt-3">Restore Record Confirmation</h4>
                            <div class="form-group">
                                <input type="hidden" name="type" value="personnel">
                                <input type="hidden" id="personnel_id_input" name="id" required>
                            </div>
                            <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to restore this record?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" name="personnel_unarchive_submit" class="btn btn-danger">Restore</button>
                    </div>
                </div>
        </div>
        </form>
    </div>

    @include ('embed.footer')

    <script type="text/javascript" src="{{ asset('js/mdb.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.js') }}"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTables for announcements table on page load
            $('#archiveTable').DataTable();

            $('.unarchiveBtn').click(function() {
                var id = $(this).data('id');

                // Show the unarchive confirmation modal
                $('#unarchiveBtn').modal('show');

                // Set the ID to be unarchived
                $('#confirmUnarchiveBtn').data('id', id);
            });

            // Add event listener to handle archive type change
            document.getElementById('archiveType').addEventListener('change', function() {
                var selectedOption = this.value;
                fetchArchives(selectedOption);
            });
        });

        function fetchArchives(option) {
            var url = '{{ route("archives.fetch") }}';
            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        option: option
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('archivesContent').innerHTML = data.html;
                    // Initialize DataTables after updating the content
                    $('#archiveTable').DataTable();

                    $('.unarchiveBtn').click(function() {
                        var id = $(this).data('id');

                        // Show the unarchive confirmation modal
                        $('#unarchiveBtn').modal('show');

                        // Set the ID to be unarchived
                        $('#confirmUnarchiveBtn').data('id', id);
                    });
                });
        }
    </script>

    <script>
        function setNewsID(id) {
            document.getElementById("announcement_id_input").value = id;
        }

        function setPageID(id) {
            document.getElementById("page_id_input").value = id;
        }

        function setPubID(id) {
            document.getElementById("publish_id_input").value = id;
        }

        function setEvalID(id) {
            document.getElementById("evaluation_id_input").value = id;
        }

        function setSpecID(id) {
            document.getElementById("spectrum_id_input").value = id;
        }

        function setPerID(id) {
            document.getElementById("personnel_id_input").value = id;
        }

        document.querySelectorAll('.arcper_Btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                setNewsID(this.getAttribute('data-id'));
                $('#announcement_unarchive').modal('show');
            });
        });

        document.querySelectorAll('.arcper_Btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                setNewsID(this.getAttribute('data-id'));
                $('#page_unarchive').modal('show');
            });
        });

        document.querySelectorAll('.arcper_Btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                setNewsID(this.getAttribute('data-id'));
                $('#publication_unarchive').modal('show');
            });
        });

        document.querySelectorAll('.arcper_Btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                setNewsID(this.getAttribute('data-id'));
                $('#spectrum_unarchive').modal('show');
            });
        });

        document.querySelectorAll('.arcper_Btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                setNewsID(this.getAttribute('data-id'));
                $('#evaluation_unarchive').modal('show');
            });
        });

        document.querySelectorAll('.arcper_Btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                setNewsID(this.getAttribute('data-id'));
                $('#personnel_unarchive').modal('show');
            });
        });

    </script>



</body>

</html>