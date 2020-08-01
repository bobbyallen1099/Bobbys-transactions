@extends('layouts.app')

@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.users.index') }}">Admin</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.users.index') }}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.users.show', $user) }}">{{ $user->name }}</a></li>
            <li class="breadcrumb-item" aria-current="page">Delete</li>
        </ol>
    </nav>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{ route('admin.users.delete', $user) }}">
                @csrf

                <div class="alert alert-danger d-flex align-items-center justify-content-between">
                    <span>Are you sure you want to delete this user?</span>
                    <button class="btn btn-sm btn-danger">Delete</button>
                </div>
            </form>
        </div>
        <div class="col-12">
            <div class="card card-body">
                <h2>{{ $user->name }}</h2>
                <p class="m-0">{{ $user->email }}</h2>
            </div>
        </div>
    </div>

@endsection
