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
</head>

<style>
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

    .button-group {
        display: flex;
    }

    .button-group button {
        margin-right: 3px;
    }

    .content {
        padding-top: 175px;
    }
</style>

<body style="background-color: #fdfdfd">

    @include('embed.header')

    <div class="content">
        <div class="container">
            <div class="body d-md-flex justify-content-between gap-0">
                <div class="box-2 d-flex flex-column">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action py-3 ripple  active" aria-current="true">
                            <i class="nav-icon fas fa-calendar fa-fw me-3"></i><span>Evaluation List</span>
                        </a>
                        <a href="{{ route('questionnaire.index') }}" class="list-group-item list-group-item-action py-3 ripple ">
                            <i class="nav-icon fas fa-file-alt fa-fw me-3"></i><span>Questionnaires</span>
                        </a>
                        <a href="{{ route('report.index') }}" class="list-group-item list-group-item-action py-3 ripple">
                            <i class="fas fa-chart-bar fa-fw me-3"></i><span>Evaluation Report</span>
                        </a>
                    </div>
                </div>
                <div class="container-fluid col-md-9">
                    <div class="row">
                        <div class="box-2 d-flex flex-column">
                            <div class="card card-outline card-primary card">
                                <div class="card">
                                    <div class="card-header">
                                        <b>Evaluation List</b>
                                        <button type="button" class="btn btn-sm btn-flat btn-primary shadows float-end" data-mdb-toggle="modal" data-mdb-target="#add">
                                            <i class="fas fa-notes-medical"></i> Add New
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th><b>#</b></th>
                                                        <th><b>Academic Year</b></th>
                                                        <th><b>Semester</b></th>
                                                        <th><b>Title</b></th>
                                                        <th><b>Default</b></th>
                                                        <th><b>Evaluation Status</b></th>
                                                        <th><b>Action</b></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($evaluations as $evaluation)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td class="text-center">{{ $evaluation->year }}</td>
                                                        <td class="text-center">{{ ordinal_suffix($evaluation->semester) }}</td>
                                                        <td class="text-center">{{ $evaluation->title }}</td>
                                                        <td class="text-center">
                                                            @if ($evaluation->is_default == 1)
                                                            <span class="badge badge-success">YES</span>
                                                            @else
                                                            <span class="badge badge-danger">NO</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($evaluation->status == 1)
                                                            <span class="badge badge-success">Starting</span>
                                                            @elseif ($evaluation->status == 2)
                                                            <span class="badge badge-danger">Closed</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            <div class="button-group">
                                                                <button type="button" data-id="{{ $evaluation->id }}" class="btn btn-sm btn-primary edit_Btn">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <button type="button" data-id="{{ $evaluation->id }}" class="btn btn-sm btn-danger archive_Btn">
                                                                    <i class="fas fa-archive"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="7">
                                                            <h1 class="text-warning mt-5 text-center">No Data Found!</h1>
                                                        </td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Evaluation -->
    <div class="modal fade" id="add" tabindex="-1" aria-labelledby="add" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{ route('evaluation.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-title">Add New Evaluation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="year">Academic Year<span class="text-danger"> *</span></label>
                            <input type="text" name="year" class="form-control" placeholder="Enter Academic Year" required>
                        </div>
                        <div class="mb-3">
                            <label for="semester">Semester<span class="text-danger"> *</span></label>
                            <input type="text" name="semester" class="form-control" placeholder="Enter Semester" required>
                        </div>
                        <div class="mb-3">
                            <label for="title">Evaluation Title<span class="text-danger"> *</span></label>
                            <input type="text" name="title" class="form-control" placeholder="Enter Evaluation Title" required>
                        </div>
                    </div>
                    <div class="modal-footer pt-4">
                        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Evaluation Modal -->
    <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="edit" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{ route('evaluation.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-title">Update Evaluation Info</h1>
                            <i data-bs-dismiss="modal" aria-label="Close"></i>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="eval_id" id="eval_id">
                            <label for="year">Academic Year<span class="text-danger"> *</span></label>
                            <input type="text" name="years" class="form-control form-control-sm" id="years" placeholder="Enter Academic Year" required>
                        </div>
                        <div class="mb-3">
                            <label for="semester">Semester<span class="text-danger"> *</span></label>
                            <input type="text" name="semesters" class="form-control form-control-sm" id="semesters" placeholder="Enter Semester" required>
                        </div>
                        <div class="mb-3">
                            <label for="title">Title<span class="text-danger"> *</span></label>
                            <textarea type="text" name="titles" class="form-control form-control-sm" id="titles" placeholder="Enter Semester" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="control-label">Status<span class="text-danger"> *</span></label>
                            <select name="status" id="status" class="form-control form-control-sm custom-select custom-select-sm select2">
                                <option hidden value="">Select Evaluation status</option>
                                <option value="1">Starting</option>
                                <option value="2">Closed</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="control-label">Default<span class="text-danger"> *</span></label>
                            <select name="is_default" id="is_default" class="form-control form-control-sm form-control-sm custom-select custom-select-sm select2">
                                <option hidden value="">Select default status</option>
                                <option value="1">YES</option>
                                <option value="0">NO</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer pt-4 ">
                        <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" name="handle_submit_update" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Archive Confirmation Modal -->
    <div class="modal fade" id="archive" tabindex="-1" aria-labelledby="archive" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="POST" action="{{ route('evaluation.archive') }}" id="archiveForm">
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

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

    <script>
        // Edit modal for evaluation
        $('.edit_Btn').on('click', function(event) {
            event.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                method: 'POST',
                url: "{{ route('evaluation.fetch') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    eval_id: id
                },
                success: function(response) {
                    if (response.error) {
                        console.log("Error: No rows found.");
                    } else {
                        let data = response.data;
                        $('#eval_id').val(data.id);
                        $('#titles').val(data.title);
                        $('#years').val(data.year);
                        $('#semesters').val(data.semester);
                        $('#status').val(data.status);
                        $('#is_default').val(data.is_default);
                    }
                }
            });
            $('#edit').modal('show');
        });

        // Archive modal for publication
        $('.archive_Btn').on('click', function(event) {
            event.preventDefault();
            let id = $(this).data('id');
            $('#archive_id_input').val(id);
            $('#archive').modal('show');
        });
    </script>
</body>

</html>