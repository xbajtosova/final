@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{__('Students')}}</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{__('Name')}}</th>
                <th>{{__('Generated Examples')}}</th>
                <th>{{__('Solved Examples')}}</th>
                <th>{{__('Points')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->generated_examples }}</td>
                <td>{{ $user->solved_examples }}</td>
                <td>{{ $user->points }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">
            <a href="{{ route('exportCSV') }}" type="submit" class="btn btn-primary">
                {{ __('Download CSV') }}
            </a>
        </div>
    </div>
</div>
@endsection
