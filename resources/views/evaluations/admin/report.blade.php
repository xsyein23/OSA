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
    <!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet"> -->

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
                        <a href="{{ route('questionnaire.index') }}" class="list-group-item list-group-item-action py-3 ripple">
                            <i class="nav-icon fas fa-file-alt fa-fw me-3"></i><span>Questionnaires</span>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action py-3 ripple  active ">
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
                                        <h4>Evaluation Report</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="downloadButtonContainer">
                                        <button type="button" style="margin-bottom: 10px;" class="btn btn-primary float-end" data-mdb-toggle="modal" data-mdb-target="#report">
                                            DOWNLOAD REPORT
                                        </button>
                                    </div>
                                    <form action="{{ route('report.fetchReportInfo') }}" id="manage-question" method="POST">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <select name="evaluationID" class="custom-select custom-select-sm select2 form-control form-control-sm mb-2" id="evaluationSelect">
                                                <option selected disabled >Select evaluation</option>
                                                @foreach($evaluations as $evaluation)
                                                <option value="{{ $evaluation->id }}">{{ $evaluation->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                    <div id="evaluationInfo">
                                        <canvas id="barGraph"></canvas>
                                    </div>
                                    <div id="evaluationInfo2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Report Modal -->
    <div class="modal fade" id="report" tabindex="-1" aria-labelledby="report" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header bg-success text-white p-3">
                        <h5 class="modal-title">Evaluation List</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>List of Respondents</th>
                                    <th>Summary Report</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($evaluations as $index => $evaluation)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $evaluation->title }}</td>
                                    <td class="align-center">
                                        <a href="{{ route('report.listInfo', ['downloadID' => $evaluation->id]) }}" type="button" class="btn btn-sm btn-success">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    </td>
                                    <td class="">
                                        <a href="{{ route('report.printInfo', ['downloadID' => $evaluation->id]) }}" type="button" class="btn btn-sm btn-danger">
                                            <i class="fas fa-file-pdf"></i>
                                        </a>
                                        <a href="{{ route('report.excelInfo', ['downloadID' => $evaluation->id]) }}" type="button" class="btn btn-sm btn-success">
                                            <i class="fa-solid fa-file-csv"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.0/mdb.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script> -->


    <script>
        $(document).ready(function() {
            var displayedQuestions = [];

            function updateContent(data) {
                var infoHtml = '<br><div class="table-responsive">';
                infoHtml += '<table class="table table-bordered">';
                infoHtml += '<thead><tr><th style="width: 55%;"><b>Question</b></th><th style="width: 20%;"><b>Average Rating</b></th><th style="width: 20%;"><b>Status</b></th></tr></thead>';
                infoHtml += '<tbody>';

                data.questions.forEach(function(question) {
                    if (displayedQuestions.indexOf(question.id) === -1) {
                        infoHtml += '<tr>';
                        infoHtml += '<td>' + question.question + '</td>';
                        infoHtml += '<td>' + question.average_score.toFixed(1) + '</td>';
                        infoHtml += '<td>' + question.status + '</td>';
                        infoHtml += '</tr>';
                        displayedQuestions.push(question.id);
                    }
                });

                infoHtml += '</tbody></table>';
                infoHtml += '</div>';
                $('#evaluationInfo2').html(infoHtml);
            }

            var barGraph;
            var collegeColors = {
                'COLLEGE OF AGRICULTURE': '#008000',
                'COLLEGE OF ARTS AND SOCIAL SCIENCES': '#A52A2A',
                'COLLEGE OF BUSINESS ADMINISTRATION AND ACCOUNTANCY': '#0000FF',
                'COLLEGE OF EDUCATION': '#FFFF00',
                'COLLEGE OF ENGINEERING': '#800000',
                'COLLEGE OF FISHERIES': '#FF0000',
                'COLLEGE OF HOME SCIENCE AND INDUSTRY': '#FFC0CB',
                'COLLEGE OF VETERINARY SCIENCE AND MEDICINE': '#6BCAE2',
                'COLLEGE OF SCIENCE': '#000000',
                'OTHER COLLEGE': '#808080'
            };

            function renderBarGraph(labels, data, colors) {
                if (barGraph) {
                    barGraph.destroy();
                }
                var barGraphCanvas = document.getElementById('barGraph').getContext('2d');
                barGraph = new Chart(barGraphCanvas, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Number of Respondents',
                            data: data,
                            backgroundColor: colors,
                            borderColor: colors,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true,
                                stepSize: 1
                            }
                        }
                    }
                });
            }

            $('#evaluationSelect').change(function() {
                var selectedEvaluationId = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('report.fetchReportInfo') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        evaluationID: selectedEvaluationId
                    },
                    success: function(response) {
                        var data = response.data;

                        // Update table content
                        updateContent(data);

                        // Update bar graph
                        if (data.college_counts && data.college_counts.length > 0) {
                            var barGraphLabels = data.college_counts.map(function(college) {
                                return college.college;
                            });

                            var barGraphData = data.college_counts.map(function(college) {
                                return parseInt(college.total_colleges, 10);
                            });

                            var barGraphColors = barGraphLabels.map(function(college) {
                                return collegeColors[college] || '#808080';
                            });

                            renderBarGraph(barGraphLabels, barGraphData, barGraphColors);
                        } else {
                            console.log('No college counts data found.');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('AJAX Error:', textStatus, errorThrown);
                    }
                });
            });
        });
    </script>


</body>

</html>