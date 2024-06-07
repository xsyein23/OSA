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
    .content {
        padding-top: 175px;
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

    .buttons {
        display: flex;
    }

    .buttons button {
        margin-right: 3px;
    }
</style>

<body>
    @include('embed.header')

    <div class="content">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-1 mb-4">
                    <a href="{{ route('questionnaire.index') }}" type="button"><span class="fa-solid fa-arrow-left"></span>&nbspBack</a>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card card-info card-primary">
                        <div class="card-header">
                            <b>Criteria</b>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('questionnaire.addQuestion', $evaluation->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="evaluation_id" value="{{ $evaluation->id }}">
                                <div class="form-group mb-3">
                                    <label for="">Criteria <span class="text-danger">*</span></label>
                                    <button type="button" class="btn btn-sm btn-flat btn-primary shadows float-end mb-2" data-mdb-toggle="modal" data-mdb-target="#add_criteria">
                                        <i class="fas fa-notes-medical"></i>
                                    </button>
                                    <select name="criteria_id" class="custom-select custom-select-sm select2" required>
                                        <option hidden value="">Select criteria</option>
                                        @foreach($evaluation->criteria as $criteria)
                                        <option value="{{ $criteria->id }}">{{ $criteria->criteria }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Question <span class="text-danger">*</span></label>
                                    <textarea name="question" cols="30" rows="4" class="form-control" required></textarea>
                                </div>
                                <br>
                                <div class="d-flex justify-content-end w-100">
                                    <button type="submit" class="btn btn-sm btn-flat btn-success bg-gradient-secondary mx-1">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 mb-4">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <b>Evaluation Questionnaire for {{ $evaluation->title }}</b>
                        </div>
                        <div class="card-body">
                            <form id="order-question">
                                <div class="clear-fix mt-2"></div>
                                @foreach($evaluation->criteria as $criteria)
                                <table class="table table-condensed">
                                    <thead>
                                        <tr class="bg-gradient-secondary">
                                            <td colspan="2" class="p-1"><b>{{ $criteria->criteria }}</b></td>
                                            <td class="p-1 text-center" width="5px">
                                                <div class="buttons">
                                                    <button type="button" data-id="{{ $criteria->id }}" class="btn btn-primary btn-sm btn-sm-flat edit_criteria_Btn">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" data-id="{{ $criteria->id }}" class="btn btn-sm btn-danger del_criteria_Btn">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody class="tr-sortable">
                                        @foreach($criteria->questions as $question)
                                        <tr class="bg-white">
                                            <td class="p-1 text-center" width="5px">
                                                <div class="button-groups">
                                                    <button type="button" data-id="{{ $question->id }}" class="btn btn-sm btn-sm-flat btn-primary edit_question_Btn d-block">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <button type="button" data-id="{{ $question->id }}" class="btn btn-sm btn-sm-flat btn-danger del_question_Btn d-block">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $question->question }}
                                                <input type="hidden" name="qid[]" value="{{ $question->id }}">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @endforeach
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Criteria Modal  -->
    <div class="modal fade" id="add_criteria" tabindex="-1" aria-labelledby="add_criteria" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{ route('questionnaire.addCriteria', $evaluation->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-title">Add Criteria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="criteria">Criteria Name<span class="text-danger"> *</span></label>
                            <input type="text" name="criteria" class="form-control" placeholder="Enter Criteria Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description">Description<span class="text-danger"> *</span></label>
                            <textarea name="description" class="form-control" placeholder="Enter Criteria Description" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer pt-4">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Criteria Modal -->
    <div class="modal fade" id="edit_criteria" tabindex="-1" aria-labelledby="edit_criteria" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{ route('questionnaire.updateCriteria', ['evaluation' => $evaluation->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-title">Update Criteria</h1>
                            <i data-bs-dismiss="modal" aria-label="Close"></i>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="criteria_id" id="criteria_id">
                            <label for="criteria">Criteria name<span class="text-danger"> *</span></label>
                            <textarea type="text" name="criterias" class="form-control" id="criterias" placeholder="Enter question" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="description">Criteria description<span class="text-danger"> *</span></label>
                            <textarea type="text" name="descriptions" class="form-control" id="descriptions" placeholder="Enter question" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer pt-4 ">
                        <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" name="handle_criteria_update" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Criteria Modal -->
    <div class="modal fade" id="delete_criteria" tabindex="-1" aria-labelledby="delete_criteria" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="POST" action="{{ route('questionnaire.deleteCriteria', ['evaluation' => $evaluation->id]) }}" id="archiveForm">
                    @csrf
                    <div class="modal-header bg-danger text-white p-4">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <i class="fas fa-circle-exclamation text-danger justify-content-center d-flex"></i>
                        <div class="col content-modal mt-5">
                            <h4 class="justify-content-center d-flex fw-semibold pt-3">Delete Criteria Confirmation</h4>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="criteria_id_input" name="criteria_id_input" required>
                            </div>
                            <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to delete this record?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Question Modal -->
    <div class="modal fade" id="edit_question" tabindex="-1" aria-labelledby="edit_question" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form action="{{ route('questionnaire.updateQuestion', ['evaluation' => $evaluation->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-title">Update Question</h1>
                            <i data-bs-dismiss="modal" aria-label="Close"></i>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" name="question_id" id="question_id">
                            <label for="question">Question<span class="text-danger"> *</span></label>
                            <textarea type="text" name="questions" class="form-control" id="questions" placeholder="Enter question" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer pt-4 ">
                        <button type="button" class="btn" data-mdb-dismiss="modal">Cancel</button>
                        <button type="submit" name="handle_question_update" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Question Modal -->
    <div class="modal fade" id="delete_question" tabindex="-1" aria-labelledby="delete_question" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <form method="POST" action="{{ route('questionnaire.deleteQuestion', ['evaluation' => $evaluation->id]) }}">
                    @csrf
                    <div class="modal-header bg-danger text-white p-4">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <i class="fas fa-circle-exclamation text-danger justify-content-center d-flex"></i>
                        <div class="col content-modal mt-5">
                            <h4 class="justify-content-center d-flex fw-semibold pt-3">Delete Question Confirmation</h4>
                            <div class="form-group">
                                <input type="hidden" class="form-control" id="question_id_input" name="question_id_input" required>
                            </div>
                            <p class="justify-content-center d-flex text-black-50 mt-3">Are you sure you want to delete this record?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @include('embed.footer')

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->


    <script>
        // Edit modal for criteria
        $('.edit_criteria_Btn').on('click', function(event) {
            event.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                method: 'POST',
                url: "{{ route('questionnaire.fetchCriteria') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    criteria_id: id
                },
                success: function(response) {
                    if (response.error) {
                        console.log("Error: No rows found.");
                    } else {
                        let data = response.data;
                        $('#criteria_id').val(data.id);
                        $('#criterias').val(data.criteria);
                        $('#descriptions').val(data.description);
                    }
                }
            });
            $('#edit_criteria').modal('show');
        });

         // Edit modal for question
         $('.edit_question_Btn').on('click', function(event) {
            event.preventDefault();
            let id = $(this).data('id');

            $.ajax({
                method: 'POST',
                url: "{{ route('questionnaire.fetchQuestion') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    question_id: id
                },
                success: function(response) {
                    if (response.error) {
                        console.log("Error: No rows found.");
                    } else {
                        let data = response.data;
                        $('#question_id').val(data.id);
                        $('#questions').val(data.question);
                    }
                }
            });
            $('#edit_question').modal('show');
        });

        // Delete modal for criteria
        $('.del_criteria_Btn').on('click', function(event) {
            event.preventDefault();
            let id = $(this).data('id');
            $('#criteria_id_input').val(id);
            $('#delete_criteria').modal('show');
        });

        // Delete modal for question
        $('.del_question_Btn').on('click', function(event) {
            event.preventDefault();
            let id = $(this).data('id');
            $('#question_id_input').val(id);
            $('#delete_question').modal('show');
        });
    </script>


</body>

</html>