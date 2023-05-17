
@extends('layouts.app')
@section('content')
@include('includes.documentation')

<div class="text-center">
    <a href="{{ route('generatePDF') }}" class="btn btn-primary">{{ __('Download PDF') }}</a>
</div>
@endsection



