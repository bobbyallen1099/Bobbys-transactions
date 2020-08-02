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

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="m-0">User Details</h3>
                    <div>
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary btn-xs">Edit user</a>
                        <a href="{{ route('admin.users.transactions', $user) }}" class="btn btn-dark btn-xs">View transactions</a>
                    </div>
                </div>
                <div class="card-body">
                    <h2>{{ $user->name }}</h2>
                    <h4>{{ $user->email }}</h4>
                </div>

                @if ($user != Auth::user())
                    <div class="card-footer">
                        <a href="{{ route('admin.users.confirmdelete', $user) }}" class="btn btn-danger btn-xs">Delete</a>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="m-0">User notes</h3>
                    <a href="{{ route('admin.users.note.create', $user) }}" class="btn btn-primary">Add a new note</a>
                </div>
                <div class="card-body">
                    @foreach ($user->notes()->latest()->get() as $note)
                        <div class="card p-3 mb-3">
                            <h5>{{ $note->title }}</h5>
                            <p class="mb-0">{{ $note->description }}</p>
                        </div>


                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection
