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
</style>

<body>
    @include('embed.header')

    <div class="content">
        <div class="container">
            <div class="body d-md-flex justify-content-between gap-0">
                <div class="box-2 d-flex flex-column">
                    <div class="list-group list-group-flush">
                        <a href="{{ route('evaluations.admin.index') }}" class="list-group-item list-group-item-action py-3 ripple " aria-current="true">
                            <i class="nav-icon fas fa-calendar fa-fw me-3"></i><span>Evaluation List</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action py-3 ripple active ">
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
                                <div class="card-header">
                                    <div class="card-tools">
                                        <h4>Manage Questionnaires</h4>
                                    </div>
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
                                                    <th><b>Questions</b></th>
                                                    <th><b>Action</b></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($evaluations as $evaluation)
                                                <tr>
                                                    <th class="text-center">{{ $loop->iteration }}</th>
                                                    <td class="text-center">{{ $evaluation->year }}</td>
                                                    <td class="text-center">{{ ordinal_suffix($evaluation->semester) }}</td>
                                                    <td class="text-center">{{ $evaluation->title }}</td>
                                                    <td class="text-center">{{ $evaluation->questions_count }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('questionnaire.manage', $evaluation->id) }}" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info">
                                                            Manage
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
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

</body>

</html>