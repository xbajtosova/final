@extends('layouts.app')

@section('content')


    <script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

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
    <a class="btn btn-primary" href="{{ route('upload')}}">{{ __('Upload files') }}</a>

    <a class="btn btn-primary" href="{{ route('delete-directory')}}">{{ __('Clear files') }}</a>


@endsection
