<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office of Student Affairs</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" class="icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="https://cdn.tiny.cloud/1/n46xtsacbhbxjsimv4eyp5etxtgm41hzte71yebrsou8dm4r/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/mdb.min.css') }}" />

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</head>
@include('embed.link')
</head>
<style>
    .header {
        display: flex;
        align-items: center;
        padding-left: 30px;
    }

    .icon {
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9999px;
        background-color: rgba(96, 165, 250, 1);
        padding: 0.5rem;
        color: rgba(255, 255, 255, 1);
    }

    .icon svg {
        height: 2rem;
        width: 2rem;
    }

    .alert {
        font-weight: 600;
        color: rgba(107, 114, 128, 1);
    }

    .load {
        display: none;
    }

    .show {
        display: block;
    }

    .error_message {
        display: none;
    }

    .content {
        padding-top: 150px;
    }
</style>

<body style="background-color: #fdfdfd">

    @include('embed.header')

    <div class="content">
        <div class="container pt-5">
            <div class="row">
                <div class="osa-tag">
                    <p class="tag-info">PREVIOUS COMPLAINTS</p>
                    <p class="tag-sub">Here are all the previous student complaints.</p>
                </div>
            </div>
        </div>
        <div class="container pt-3" id="complainContainer">
            @if(count($complaints) > 0)
            <table id='complainTable' class='display cell-border'>
                <thead>
                    <tr class="text-center">
                        <th>Student ID Number</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>College</th>
                        <th>Course</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complaints as $complaint)
                    <tr class="text-center">
                        <td>{{ $complaint->student_id }}</td>
                        <td>{{ $complaint->user_name }}</td>
                        <td>{{ $complaint->user_email }}</td>
                        <td>{{ $complaint->user_college }}</td>
                        <td>{{ $complaint->user_course }}</td>
                        <td>
                            <button class="btn btn-sm btn-flash-border-primary bg-primary text-white view-details" data-id="{{ $complaint->id }}" data-toggle="tooltip" data-placement="top" title="View Details">
                                View Details
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h1 class="text-warning mt-5">No previous Complaints!</h1>
            @endif
        </div>
    </div>

    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success text-white p-3">
                    <h5 class="modal-title">Complaint Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
                    <!-- Complaint details will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    @include('embed.footer')


    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable
            $('#complainTable').DataTable();

            // Add event listener to view details buttons
            document.querySelectorAll('.view-details').forEach(function(button) {
                button.addEventListener('click', function() {
                    var complaintId = this.getAttribute('data-id');
                    fetchComplaintDetails(complaintId);
                });
            });
        });

        function fetchComplaintDetails(complaintId) {
            var url = '{{ route("previous.details") }}';

            fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        id: complaintId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modal-body').innerHTML = data.html;
                    $('#detailsModal').modal('show'); // Ensure correct initialization
                })
                .catch(error => console.error('Error fetching complaint details:', error));
        }
    </script>
</body>

</html>