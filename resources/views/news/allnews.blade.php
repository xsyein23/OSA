<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Office of Student Affairs</title>
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}" class="icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    @include('embed.link')
</head>

<style>
    .sticky-top {
        position: sticky;
        top: 155px;
        font-size: 18px;
    }

    .d-flex {
        display: flex;
    }

    .bg-image {
        margin-right: 15px;
        /* Adjust as needed */
    }

    .active {
        /* background-color: lightgreen; */
        color: white;
        background: -webkit-linear-gradient(0deg, #008102, #93d12d);
        /* font-size: 18px; */
    }

    /* Style for active list item */
    li.active a {
        color: white;
        /* Set the text color to white */
    }

    /* Style for non-active list items */
    li:not(.active) a {
        color: black;
        /* Set the text color to black */
    }

    a,
    a:hover,
    a:focus,
    a:active {
        text-decoration: none;
        color: green;
    }

    a:hover {
        color: yellowgreen;

    }

    #card-news {
        /* padding: 20px; */
        transition: transform 0.3s ease;
    }

    #card-news:hover {
        transform: translateY(-5px);
    }

    .content {
        /* Adjust the padding top to prevent content from being hidden behind the fixed navbar */
        padding-top: 144px;
        /* Assuming the navbar height is 70px */
    }
</style>

<body>

    @include('embed.header')

    <div class="content">
        <div class="bg-image ripple" data-mdb-ripple-color="light">
            <img src="{{ asset('assets/img/banner1.1.png') }}" class="banner__img" style="height: 30vh;" />
            <a href="#!">
                <div class="mask" style="background-color: hsla(0, 0%, 0%, 0.5)">
                    <div class="d-flex justify-content-center align-items-center h-100 text-center">
                        <h2 class="text-white mb-0">NEWS AND EVENTS</h2>
                    </div>
                </div>
            </a>
        </div>
        <div class="container pt-4">
            <div class="row">
                <div class="col-lg-3 white-bg sticky-top">
                    <ul class="">
                        <li><a href="{{ route('news.index') }}">&nbsp;&nbsp;&nbsp;&nbsp;NEWS</a></li>
                        <li class="active"><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;ALL NEWS</a></li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-3">
                            <h6 class="text-muted">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SORT BY YEAR
                            </h6>
                            <ul class="align-items-start" id="yearList">
                                @foreach ($years as $year)
                                <li class="{{ $year->year == $currentYear ? 'active' : '' }}" style="{{ $year->year == $currentYear ? 'font-size: 18px;' : '' }}">
                                    &nbsp;&nbsp;&nbsp;{{ $year->year }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-lg-9">
                            <div class="accordion" id="accordionExample">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('embed.footer')




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.js"></script>

    <script>
        $(document).ready(function() {
            loadYears();

            var currentYear = new Date().getFullYear();
            loadAccordionContent(currentYear);

            $(document).on('click', '#yearList li', function() {
                $('#yearList li').removeClass('active');

                $(this).addClass('active');

                var year = $(this).text().trim();
                loadAccordionContent(year);
            });
        });

        function loadYears() {
            $.ajax({
                url: '{{ route("news.fetchYears") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var years = response.years;
                    var yearHtml = '';
                    years.forEach(function(year) {
                        yearHtml += '<li class="' + (year.year == currentYear ? 'active' : '') + '">' + year.year + '</li>';
                    });
                    $('#yearList').html(yearHtml);
                }
            });
        }

        function loadAccordionContent(year) {
            $.ajax({
                url: '{{ route("news.fetchMonths") }}',
                type: 'POST',
                data: {
                    year: year,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var months = response.months;
                    var accordionContent = '';
                    months.forEach(function(month) {
                        accordionContent += '<div class="accordion-item">' +
                            '<h2 class="accordion-header" id="heading' + month.month + '">' +
                            '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' + month.month + '" aria-expanded="true" aria-controls="collapse' + month.month + '">' +
                            month.month_name +
                            '</button>' +
                            '</h2>' +
                            '<div id="collapse' + month.month + '" class="accordion-collapse collapse" aria-labelledby="heading' + month.month + '" data-bs-parent="#accordionExample">' +
                            '<div class="accordion-body">' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    });
                    $('#accordionExample').html(accordionContent);

                    if (months.length > 0) {
                        var firstMonth = months[0].month;
                        loadMonthEntries(year, firstMonth);
                    }
                }
            });
        }

        function loadMonthEntries(year, month) {
            $.ajax({
                url: '{{ route("news.fetchMonthEntries") }}',
                type: 'POST',
                data: {
                    year: year,
                    month: month,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var entries = response.entries;
                    var entryHtml = '';
                    var basePath = '{{ asset('
                    upload / announcements / ') }}';
                    var detailsUrl = '{{ route("news.details", ["id" => ":id"]) }}';
                    entries.forEach(function(entry) {
                        var entryDetailsUrl = detailsUrl.replace(':id', entry.id);
                        var coverImageUrl = basePath + '/' + entry.cover;
                        entryHtml += '<div class="">' +
                            '<div class="row">' +
                            '<div class="col-md-3">' +
                            '<div class="bg-image hover-overlay ripple">' +
                            '<img src="' + coverImageUrl + '" class="card-img-top" alt="" style="height: 8vh; object-fit: cover; width: 10vh;" />' +
                            // '<img src="' + entry.cover + '" class="card-img-top" alt="" style="height: 8vh; object-fit: cover; width: 10vh;" />' +
                            '</div>' +
                            '</div>' +
                            '<div class="col-md-9">' +
                            '<div class="card-body">' +
                            '<h6><a href="' + entryDetailsUrl + '">' + entry.title + '</a></h6>' +
                            '<small class="text-muted">' + entry.date_created +
                            '</small>' +
                            '</div>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    });
                    $('#collapse' + month + ' .accordion-body').html(entryHtml);
                }
            });
        }
    </script>

</body>

</html>