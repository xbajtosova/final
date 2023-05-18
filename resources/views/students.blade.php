@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{__('Students')}}</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{__('Name')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
