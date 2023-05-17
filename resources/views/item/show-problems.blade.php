<!DOCTYPE html>
<html>
<head>
    <title>{{__('Math Problems')}}</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
</head>
<body>
    <h1>{{__('Math Problems')}}</h1>
    @if (!empty($problems))
        @foreach ($problems as $problem)
            <div class="math-problem">
                <h3>{{ $problem['title'] }}</h3>
                <p>{!! $problem['task'] !!}</p>
                <p>{!! $problem['solution'] !!}</p>
            </div>
        @endforeach
    @else
        <p>{{__('No problems found.')}}</p>
    @endif
    <form action="{{ route('redirectToUpload') }}" method="POST">
    @csrf
    <button type="submit">{{__('Upload Another')}}</button>
</form>
</body>
</html>
