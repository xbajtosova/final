@extends('layouts.app')

@section('content')


    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <h1>{{ __('Examples') }}</h1>
    <a href="{{ route('generateExample') }}" class="btn btn-primary">{{ __('Generate math problem') }}</a>
    @if (!empty($example))
        <div class="example">
            <h3>{{ __('Math problem ID:') }} {{ $example->id }}</h3>
            <p>{!! $example->example !!}</p>
            <button id="hintButton" class="btn btn-secondary">Hint</button>
            <p id="solution" style="display: none;">{!! $example->answer !!}</p>
            <p id="correctInput" style="display: none;"><strong>{{ __('Correct input:') }}</strong> <span id="correctInputValue"></span></p>
        </div>
        <div class="user-input">
            <h3>Your solution:</h3>
            <textarea id="userSolution" class="form-control"></textarea>
            <button id="checkSolutionButton" class="btn btn-primary mt-3">{{ __('Check Solution') }}</button>
            <p id="resultMessage" style="display: none;"></p>
        </div>
        <!-- Hidden input field to hold the correct solution -->
        <input type="hidden" id="correctSolution" value="{{ str_replace(["\\", "[", "]", "dfrac", " "], '', $example->answer) }}">
    @endif
    <script>
        $(document).ready(function(){
            $("#hintButton").click(function(){
                $("#solution").toggle();
                var correctInput = $("#correctSolution").val();
                $("#correctInputValue").text(correctInput);
                $("#correctInput").toggle();
            });

            $("#checkSolutionButton").click(function(){
                var userSolution = $("#userSolution").val().trim().replace(/ /g, '');
                var correctSolution = $("#correctSolution").val().replace(/\n/g, '').trim();
                var route = "{{ route('addSolvedExample') }}";
                    fetch(route, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    })


                console.log('User solution: "' + userSolution + '"');
                console.log('Correct solution: "' + correctSolution + '"');

                if (userSolution === correctSolution) {
                    $("#resultMessage").css("color", "green").text("Correct Answer").show();
                    var route = "{{ route('addPoints') }}";
                    fetch(route, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    })
                } else {
                    $("#resultMessage").css("color", "red").text("Incorrect").show();
                }
            });
        });
    </script>
@endsection
