<!DOCTYPE html>
<html>
<head>
    <title>Examples</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</head>
<body>
    <h1>Examples</h1>
    @if (!empty($examples))
        @foreach ($examples as $example)
            <div class="example">
                <h3>{{ $example->id }}</h3>
                <p>{!! $example->example !!}</p>
                <p>{!! $example->answer !!}</p>
            </div>
        @endforeach
    @else
        <p>No examples found.</p>
    @endif
</body>
</html>
