@extends('layouts.app')

@section('content')

    {{ Breadcrumbs::render('admin.users.show', $user) }}

    @if(Session::has('message'))
        <div class="alert {{ Session::get('alert-class', 'alert-info') }}">
            {{ Session::get('message') }}
            @if(Session::has('name'))
                <strong>'{{ Session::get('name') }}'</strong>
            @endif
        </div>
    @endif
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h2>{{ $user->name }}</h2>
                    <h4>{{ $user->email }}</h4>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-xs">Edit</a>
            <a href="{{ route('admin.users.transactions', $user) }}" class="btn btn-info btn-xs">View transactions</a>

            @if ($user != Auth::user())
                <a href="{{ route('admin.users.confirmdelete', $user) }}" class="btn btn-danger btn-xs">Delete</a>
            @endif
        </div>
    </div>
@endsection
