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
    #submitStep {
        padding-right: 20px;
        padding-left: 20px;
    }

    #comments {
        padding: 10px;
    }

    .button-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-left: 25px;
        padding-right: 25px;
    }

    .button-container button {
        margin-bottom: 10px;
    }

    .content {
        padding-top: 85px;
    }
</style>

<body style="background-color: #fdfdfd">

    @include('embed.header');

    <div class="content">
        <div class="container pt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col justify-content-end d-flex">
                            <small>AY: {{ $evaluation->year }}, {{ ordinal_suffix($evaluation->semester) }} semester</small>
                        </div>
                    </div>
                    <div class="card-tools">
                        <h5>{{ $evaluation->title }}</h5>
                    </div>
                </div>
                <form id="manage-evaluation" method="POST" action="{{ route('evaluation.submit.student') }}">
                    @csrf
                    <input type="hidden" name="eval_id" value="{{ $evaluation->id }}">
                    @foreach ($criteriaWithQuestions as $index => $criteria)
                    <div class="step bd-example" id="step{{ $index + 1 }}" @if ($index> 0) style="display: none;" @endif>
                        <div class="card-body">
                            <small class="justify">{{ $criteria->description }}</small>
                            <hr>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr class="text-center" style="size: 1rem;">
                                            <th></th>
                                            <th><small>Very Dissatisfied<br>(1)</small></th>
                                            <th><small>Dissatisfied<br>(2)</small></th>
                                            <th><small>Neutral<br>(3)</small></th>
                                            <th><small>Satisfied<br>(4)</small></th>
                                            <th><small>Very Satisfied<br>(5)</small></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($criteria->questions as $question)
                                        <tr>
                                            <th scope="row"><small>{{ $question->question }}</small></th>
                                            <input type="hidden" name="qid[]" value="{{ $question->id }}">
                                            @for ($c = 1; $c <= 5; $c++) <td class="text-center">
                                                <div>
                                                    <input type="radio" name="rate[{{ $question->id }}]" id="qradio{{ $question->id }}_{{ $c }}" value="{{ $c }}" required />
                                                    <label for="qradio{{ $question->id }}_{{ $c }}"></label>
                                                </div>
                                                </td>
                                                @endfor
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @if ($criteriaWithQuestions->count() > 1)
                    <div class="button-container">
                        <button id="prevStep" class="btn btn-primary" disabled>Previous</button>
                        <button id="nextStep" class="btn btn-primary btn-flat" style="float: right;">Next</button>
                    </div>
                    @endif
                    <div id="submitStep" @if ($criteriaWithQuestions->count() == 1) style="display: block;" @else style="display: none;" @endif>
                        <div>
                            <textarea name="comments" id="comments" class="form-control" rows="3" placeholder="Comments/Suggestions (Optional)"></textarea>
                            <br>
                        </div>
                        <button type="submit" name="eval_submit" class="btn btn-flat btn-primary" style="float: right;">SUBMIT</button>
                    </div>
                </form>
                <br>
            </div>
        </div>
    </div>

    @include('embed.footer');

    <script type="text/javascript" src="{{ asset('assets/js/mdb.min.js') }}"></script>
    <script type="text/javascript"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let currentStep = 1;
            const totalSteps = parseInt("{{ $criteriaWithQuestions->count() }}");

            const prevButton = document.getElementById("prevStep");
            const nextButton = document.getElementById("nextStep");
            const submitButton = document.getElementById("submitStep");

            function showStep(step) {
                document.querySelectorAll(".step").forEach((s) => {
                    s.style.display = "none";
                });
                document.querySelector(`#step${step}`).style.display = "block";

                prevButton.disabled = step === 1;
                nextButton.style.display = step === totalSteps ? "none" : "block";
                submitButton.style.display = step === totalSteps ? "block" : "none";
            }
            showStep(currentStep);

            nextButton.addEventListener("click", function(event) {
                event.preventDefault(); // Prevent form submission
                if (currentStep < totalSteps) {
                    if (validateStep(currentStep)) {
                        currentStep++;
                        showStep(currentStep);
                    } else {
                        alert("Please fill in all required fields before proceeding.");
                    }
                }
            });

            prevButton.addEventListener("click", function(event) {
                event.preventDefault();
                if (currentStep > 1) {
                    currentStep--;
                    showStep(currentStep);
                }
            });

            function validateStep(step) {
                const stepContainer = document.querySelector(`#step${step}`);
                const questions = stepContainer.querySelectorAll('input[type="radio"]');
                let isValid = true;

                questions.forEach(question => {
                    const checkedRadioButtons = stepContainer.querySelectorAll(`input[type="radio"][name="${question.name}"]:checked`);
                    if (checkedRadioButtons.length !== 1) {
                        isValid = false;
                    }
                });

                return isValid;
            }
        });
    </script>
</body>

</html>