<!DOCTYPE html>
<html>
<head>
    <title>Examples</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>Examples</h1>
    <a href="{{ route('generateExample') }}" class="button">Generate Math Problem</a>
    @if (!empty($example))
        <div class="example">
            <h3>{{ $example->id }}</h3>
            <p>{!! $example->example !!}</p>
            <button id="hintButton">Hint</button>
            <p id="solution" style="display: none;">{!! $example->answer !!}</p>
            <p id="correctInput" style="display: none;"><strong>Correct Input:</strong> <span id="correctInputValue"></span></p>
        </div>
        <div class="user-input">
            <h3>Your solution:</h3>
            <textarea id="userSolution"></textarea>
            <button id="checkSolutionButton">Check Solution</button>
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

                            
                console.log('User solution: "' + userSolution + '"');
                console.log('Correct solution: "' + correctSolution + '"');
                            
                if (userSolution === correctSolution) {
                    $("#resultMessage").css("color", "green").text("Correct Answer").show();
                } else {
                    $("#resultMessage").css("color", "red").text("Incorrect").show();
                }
            });
        });
    </script>
</body>
</html>
