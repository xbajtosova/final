@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger">
                      {{ session('error') }}
                    </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!')}}

                </div>
                <div class="card-body">
                    <div class="panel-body">
                        {{ __('Check admin view:')}}
                      <a href="{{route('admin.view')}}">{{ __('Admin View')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
