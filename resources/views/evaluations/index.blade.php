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
        padding-top: 135px;
    }
</style>

<body style="background-color: #fdfdfd">

    @include('embed.header')

    <div class="content">
        <div class="bg-image ripple" data-mdb-ripple-color="light">
            <img src="{{ asset('assets/img/banner1.1.png') }}" class="banner__img" style="height: 30vh;" />
            <a href="#!">
                <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
                    <div class="d-flex justify-content-center align-items-center h-100 text-center">
                        <h2 class="text-white mb-0">RESEARCH AND EVALUATIONS</h2>
                    </div>
                </div>
            </a>
        </div>
        <div class="container pt-3">
            <div class="row">
                <div class="osa-tag">
                    <p class="tag-info">RESEARCH AND EVALUATIONS</p>
                    <p class="tag-sub">View all research and evaluations from the Office of Student Affairs (OSA)</p>
                </div>
            </div>
        </div>

        <div class="container mt-4">

            @auth
            @if(Auth::user()->userType == 'Student')
            <div class="row">
                @forelse ($evaluations as $evaluation)
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Academic Year: {{ $evaluation->year }}, {{ $evaluation->semester }} semester</h6>
                        </div>
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 font-weight-bold text-gray text-uppercase mb-3">
                                        {{ $evaluation->title }}
                                    </div>
                                    @php
                                    $userID = Auth::id(); // Correct way to get the current authenticated user's ID
                                    $num_responses = DB::table('responses')
                                    ->where('userID', $userID)
                                    ->where('evaluation_id', $evaluation->id)
                                    ->count();

                                    $num_criteria = DB::table('criteria_list')
                                    ->where('evaluation_id', $evaluation->id)
                                    ->count();
                                    @endphp

                                    @if ($num_responses > 0)
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                                        Status:
                                        <span class="badge badge-success">COMPLETED</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <span class="fas fa-check fa-3x"></span>
                                </div>
                                @else
                                <div class="h6 mb-0 font-weight-bold text-gray-800">
                                    Status:
                                    <span class="badge badge-warning">NOT STARTED</span>
                                </div>
                            </div>

                            <div class="col-auto">
                                <form action="{{ route('evaluations.student.index') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="eval_id" value="{{ $evaluation->id }}">
                                    <button class="btn badge badge-primary">EVALUATE NOW</button>
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="container p-2 justify-content-center d-flex">
                <h1 class="text-warning text-uppercase">No Data Found!</h1>
            </div>
            @endforelse
            @endif
            @endauth

            @guest
            <div class="row">
                @forelse ($evaluations as $evaluation)
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Academic Year: {{ $evaluation->year }}, {{ $evaluation->semester }} semester</h6>
                        </div>
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="h5 font-weight-bold text-gray text-uppercase mb-3">
                                        {{ $evaluation->title }}
                                    </div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800">
                                        Status:
                                        <span class="badge badge-success font-weight-bold">-----</span>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <a type="button" href="{{ route('login') }}"><span class="badge badge-primary">EVALUATE NOW</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="container p-2 justify-content-center d-flex">
                    <h1 class="text-warning text-uppercase">No Data Found!</h1>
                </div>
                @endforelse
            </div>
            @endguest

        </div>

    </div>

    @include('embed.footer')

    <!-- MDB -->
    <script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>

</html>